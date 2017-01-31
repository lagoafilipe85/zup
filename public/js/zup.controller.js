/*!
 * Teste de aplicação ZUP v1.0 (http://zup.valeup.com.br/)
 * Desensolvido por Filipe A. Ribeiro
 */
/*! ZUP.CONTROLLER.JS */

//======================= CONTROLLERS DA APLICAÇÃO SCUPTEL

//======================= DddsListaController
(function() {
    'use strict';

    angular.module('zup-app')
        .controller('ModelosListaController', ModelosListaController);

    ModelosListaController.$inject = ['$scope', '$http', 'ModelosFactory'];

    function ModelosListaController($scope, $http, ModelosFactory) {
        $scope.titulo = 'Lista de Modelos';
        $scope.filtro = '';
        ModelosFactory.listarModelos().then(function (data){
            $scope.listModelos = data.data;
        });

        $scope.newModelo = {};
        $scope.submitNewForm = function () {
            // Posting data to php file
            $http.post('api/todo', $scope.newModelo).then(function($response){
                alert('foi');
                location = 'modelo/' + $response.data.id;
            }, function($response){
                alert('não');
            });
        };

        $scope.removeModelo = function(id){
            $http.delete('api/todo/' + id).then(function($response){
                alert('foi');
                location.reload();
            }, function($response){
                alert('não');
            });
        }
    }

})();

(function() {
    'use strict';

    angular.module('zup-app')
        .controller('ModeloController', ModeloController);

    ModeloController.$inject = ['$scope', '$http'];

    function ModeloController($scope, $http) {
        $scope.titulo = 'Modelo';
        $scope.id = false;
        $scope.init = function (id) {
            $scope.id=id;

            $http.get('../api/todo/' + $scope.id).then(function($response){
                $scope.modelo = $response.data;
            }, function($response){
            });
        };

        $scope.submitUpdateForm = function() {
            $http.put('../api/todo/' + $scope.id, $scope.modelo).then(function($response){
                alert('foi');
                location.reload();
            }, function($response){
                alert('não');
            });  
        }

        $scope.removeModelo = function(id){
            $http.delete('../api/todo/' + id).then(function($response){
                alert('foi');
                location = '../modelos';
            }, function($response){
                alert('não');
            });
        }
    }

})();