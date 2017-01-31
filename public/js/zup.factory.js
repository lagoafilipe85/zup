/*!
 * Teste de aplicação ZUP v1.0 (http://zup.valeup.com.br/)
 * Desensolvido por Filipe A. Ribeiro
 */
 
(function() {
  'use strict';

  angular.module('zup-app')
    .factory('ModelosFactory', ModelosFactory)

  function ModelosFactory($q, $http) {
    var modelos = $q.defer();
    
    $http.get ( 'api/todos' )
      .then (  modelos.resolve, modelos.reject );

    return {
      listarModelos: listModelos,
    };

    function listModelos() {
      return modelos.promise;
    }
  }

})();