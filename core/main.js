/**
 * Created by msalahat on 15/09/17.
 */
var App = angular.module('codeytek', []);

App.controller('Fetch', function ($scope,$http,$window,$location) {

    $scope.reloadPage = function(){$window.location.reload();};

    $http.get('api/category.json').then(function(res){$scope.category = res.data;});

    $http.get('api/task.json').then(function(res){$scope.task = res.data;});

    $scope.remove_category=function(item){
        var data = $.param({id: item,remove:'category'});
        var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};
        $http.post('api/remove.php', data, config);
        $scope.reloadPage();
    };

    $scope.remove_task=function(item){
        var data = $.param({id: item,remove:'task'});
        var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};
        $http.post('api/remove.php', data, config);
        $scope.reloadPage();
    };

    $scope.edit_category=function(item){

    };

    $scope.edit_task=function(item){
        console.log(item);
    };

    $scope.findCategory = function(enteredValue) {
        return  enteredValue;
    };

});

App.controller('add_category', function($scope,$http,$timeout) {
    $scope.showError = false;
    $scope.doFade = false;

    $scope.fakeError = function(message){
        $scope.showSuccess = false;
        $scope.doFade = false;
        $scope.showSuccess = true;
        $scope.errorMessage = message;
        $timeout(function(){$scope.doFade = true;}, 2500);
    };
    $scope.submitForm = function() {
        if ($scope.categoryForm.$valid) {
           var data =  $.param({title: $scope.categoryForm.title.$modelValue});
            var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};
            $http.post('api/add_category.php', data, config).then(function(res){
                $scope.fakeError(res.data);
            });


        }
    };
});

App.controller('edit_category', function($scope,$http,$location) {
    var fname = $location.absUrl();
    var url = new URL(fname);
    var id = url.searchParams.get("id");
    if(id){
        $http.get('api/edit_category.php?get=1&id='+id).then(function(res){$scope.category = res.data;});
    }
    $scope.fakeError = function(message){
        $scope.showSuccess = false;
        $scope.doFade = false;
        $scope.showSuccess = true;
        $scope.errorMessage = message;
        $timeout(function(){$scope.doFade = true;}, 2500);
    };
    $scope.submitForm = function() {
        if ($scope.categoryForm.$valid) {
            var data =  $.param({id: $scope.categoryForm.id.$modelValue,title: $scope.categoryForm.title.$modelValue});
            var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};
            $http.post('api/edit_category.php', data, config).then(function(res){
                $scope.fakeError(res.data);
            });
        }
    };
});

App.controller('edit_task', function($scope,$http,$location) {
    var fname = $location.absUrl();
    var url = new URL(fname);
    var id = url.searchParams.get("id");
    $http.get('api/category.json').then(function(res){$scope.category = res.data;});
    if(id){
        $http.get('api/edit_task.php?get=1&id='+id).then(function(res){
             $scope.task = res.data;
            
        });
    }
    $scope.fakeError = function(message){
        $scope.showSuccess = false;
        $scope.doFade = false;
        $scope.showSuccess = true;
        $scope.errorMessage = message;
        $timeout(function(){$scope.doFade = true;}, 2500);
    };
    $scope.taskFormSubmit = function() {
        if ($scope.taskForm.$valid) {
            var data =  $.param({
                id: $scope.taskForm.id.$viewValue,
                title: $scope.taskForm.title.$viewValue,
                description: $scope.taskForm.description.$viewValue,
                due_date: $scope.taskForm.due_date.$viewValue,
                tags: $scope.taskForm.tags.$viewValue,
                category_id:$scope.task.category_id
            });
            var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};
            $http.post('api/edit_task.php', data, config).then(function(res){
                $scope.fakeError(res.data);
            });
        }
    };
});

App.controller('add_task', function($scope,$http,$timeout) {
    $scope.showError = false;
    $scope.doFade = false;
    $http.get('api/category.json').then(function(res){$scope.category = res.data;});
    $scope.messageAlert = function(message){
        $scope.showSuccess = false;
        $scope.doFade = false;
        $scope.showSuccess = true;
        $scope.errorMessage = message;
        $timeout(function(){$scope.doFade = true;}, 2500);
    };
    $scope.taskFormSubmit = function() {
        if ($scope.taskForm.$valid) {
            var data =  $.param({
                title: $scope.taskForm.title.$viewValue,
                description: $scope.taskForm.description.$viewValue,
                due_date: $scope.taskForm.due_date.$viewValue,
                tags: $scope.taskForm.tags.$viewValue,
                category_id:$scope.task.category
            });
            var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};
            $http.post('api/add_task.php', data, config).then(function(res){
                $scope.messageAlert(res.data);
            });
        }
    };
});

