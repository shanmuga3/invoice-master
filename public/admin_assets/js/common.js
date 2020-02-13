$(document).ready(function () {
	const csrf_token    = $("input[name='_token']").val();
    var lang            = $("html").attr('lang');
    var rtl             = (lang  == 'ar');

    // Disable Current element after click
    $(document).on('click','.disable_after_click',function(event) {
        setTimeout( () => $(this).attr('disabled','disabled') ,1);
    });
});

app.filter('checkKeyValueUsedInStack', ["$filter", function($filter) {
    return function(value, key, stack) {
        var found = $filter('filter')(stack, {name: value});
        var found_text = $filter('filter')(stack, {key: ''+value}, true);
        return !found.length && !found_text.length;
    };
}]);

app.controller("appController", function($scope, $http) {

	$('#confirm-delete').on('shown.bs.modal', function (e) {
	 	var action = $(e.relatedTarget).data('action');
	 	$('#common_delete-form').attr('action',action);
	});

	// Common function to perform http requests
    $scope.http_post = function(url, data, callback) {
        if(!data) {
          data = {};
        }
        $http.post(url, data).then(function(response) {
            if(response.status == 200) {
                if(callback) {
                    callback(response.data);
                }
            }
        });
    };

    $scope.checkInValidInput = function(value) {
        if(value == null) {
            return true;
        }
        if(typeof value == 'object') {
            return value.length == 0;
        }
        return (value == undefined || value == 0 || value == '');
    };

    // Common function to check and apply Scope value
    $scope.applyScope = function() {
        if(!$scope.$$phase) {
            $scope.$apply();
        }
    };

    $scope.setGetParameter = function(paramName, paramValue) {
        var url = window.location.href;

        if (url.indexOf(paramName + "=") >= 0) {
            var prefix = url.substring(0, url.indexOf(paramName));
            var suffix = url.substring(url.indexOf(paramName));
            suffix = suffix.substring(suffix.indexOf("=") + 1);
            suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
            url = prefix + paramName + "=" + paramValue + suffix;
        }
        else {
            url += (url.indexOf("?") < 0) ? "?" : "&";
            url += paramName + "=" + paramValue;
        }
        history.replaceState(null, null, url);
    };

    $scope.getParameterByName = function(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(window.location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    };

    // Get Checkbox Checked Values Based on given selector
    $scope.getSelectedData = function(selector) {
        var value = [];
        $(selector+':checked').each(function() {
            value.push($(this).val());
        });
        return value;
    };
});

app.controller("invoiceController", function($scope, $http) {
    $scope.addInvoiceItem = function() {
        $scope.invoice_items.push({'name':''});
    };

    $scope.removeInvoiceItem = function(index) {
        $scope.invoice_items.splice(index, 1);
    };

    $scope.updateInvoiceTotal = function(index) {
        var total = 0;
        $.each($scope.invoice_items, function(key, invoice_item) {
            let item_total = ((invoice_item.quantity * invoice_item.price) - invoice_item.discount);
            $scope.invoice_items[key].total = item_total;
            total += item_total;
        });
        if(!isNaN(total)) {
            $scope.invoice_total = total;
        }
    };
    
    $scope.addTaxItem = function() {
        console.log($scope.all_tax_types);
        $scope.added_tax_items.push({'name':''});
    };
});