function AppController($scope) {

	$scope.airports = {
		'PDX': {
			'code': 'PDX',
			'name': 'Portland International Airport',
			'city': 'Portland',
			'destinations': ['LAX', 'SFO']
		},
		'STL': {
			'code': 'STL',
			'name': 'Lambert-St. Louis International Airport',
			'city': 'St. Louis',
			'destinations': ['LAX', 'MKE']
		},
		'MCI': {
			'code': 'MCI',
			'name': 'Kansas City International Airport',
			'city': 'Kansas',
			'destinations': ['SFO', 'MKE']
		}
	};

	$scope.sidebarURL = 'partials/airport.php';

	$scope.editCurrentAirport = null;

	$scope.setAirport = function (code) {
		$scope.currentAirport = $scope.airports[code];
	};

	$scope.editAirport = function (code) {
		$scope.editCurrentAirport = $scope.airports[code];
	};

}
