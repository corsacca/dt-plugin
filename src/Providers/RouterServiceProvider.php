<?php

namespace DT\Plugin\Providers;

use DT\Plugin\CodeZone\Router;
use DT\Plugin\CodeZone\Router\FastRoute\Routes;
use DT\Plugin\CodeZone\Router\Middleware\Stack;
use DT\Plugin\FastRoute\RouteCollector;
use DT\Plugin\Illuminate\Http\Response;
use function DT\Plugin\namespace_string;
use function DT\Plugin\routes_path;

class RouterServiceProvider extends ServiceProvider {
	/**
	 * Do any setup needed before the theme is ready.
	 * DT is not yet registered.
	 */
	public function register(): void {
		Router::register( [
			'container' => $this->container,
		] );

		add_filter( Router\namespace_string( "routes" ), [ $this, 'include_route_file' ], 1 );
		add_action( Router\namespace_string( 'render' ), [ $this, 'render_response' ], 10, 2 );
	}

	/**
	 * Do any setup needed before the theme is ready.
	 * DT is not yet registered.
	 */
	public function boot(): void {
		if ( is_admin() ) {
			return;
		}

		apply_filters( namespace_string( 'middleware' ), $this->container->make( Stack::class ) )
			->run();
	}

	/**
	 * Register the routes for the application.
	 *
	 * @param Routes $r
	 *
	 * @return Routes
	 */
	public function include_route_file( Routes $r ): RouteCollector {

		include routes_path( 'web.php' );

		return $r;
	}

	public function render_response( Response $response ) {
		if ( apply_filters( 'dt_blank_access', false ) ) {
			add_action( 'dt_blank_body', function () use ( $response ) {
				echo $respones->getContent();
			} );
		} else {
			$response->send();
		}
	}
}
