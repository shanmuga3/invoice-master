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

    $(document).ready(function() {
        $scope.invoice_total = 0;
        $scope.invoice_sub_total = 0;
        $scope.selectedTaxItems = [];
        $scope.applyScope();
    });
    $scope.addInvoiceItem = function() {
        $scope.invoice_items.push({'name':''});
    };

    $scope.removeInvoiceItem = function(index) {
        $scope.invoice_items.splice(index, 1);
        $scope.updateInvoiceTotal();
    };

    $scope.updateInvoiceTotal = function(index) {
        var invoice_total = 0;
        $scope.invoice_total = 0;
        $.each($scope.invoice_items, function(key, invoice_item) {
            let isInvalid = ($scope.checkInValidInput(invoice_item.quantity) || $scope.checkInValidInput(invoice_item.price));
            let item_total = ((invoice_item.quantity * invoice_item.price) - invoice_item.discount);
            if(!isInvalid && !isNaN(item_total)) {
                if(item_total < 0) {
                    item_total = 0;
                }
                $scope.invoice_items[key].total = item_total;
                invoice_total += item_total;
            }
        });
        $scope.invoice_sub_total = invoice_total;
        var tax_total = 0;
        $.each($scope.added_tax_types, function(key, tax_type) {
            let tax_item_total = tax_type.value;
            $scope.added_tax_types[key].tax_value = $scope.currency_symbol+' '+tax_type.value;
            
            if(tax_type.type == 'percent') {
                $scope.added_tax_types[key].tax_value = tax_type.value+'%';
                tax_item_total = invoice_total*(tax_type.value / 100);
            }

            $scope.added_tax_types[key].total = $scope.currency_symbol+' '+tax_item_total;
            tax_total += parseFloat(tax_item_total);
        });

        if(isNaN(invoice_total)) {
            invoice_total = 0;
        }
        if(isNaN(tax_total)) {
            tax_total = 0;
        }
        $scope.invoice_total = parseFloat(invoice_total) + parseFloat(tax_total);
    };

    $scope.addTaxItem = function() {
        var selected = $scope.tax_types[$scope.selected_tax];
        $scope.selectedTaxItems.push(selected.name);
        $scope.selected_tax = '';
        $scope.added_tax_types.push(selected);
        $scope.updateInvoiceTotal();
    };

    $scope.removeTaxItem = function(index) {
        var selected_index = $scope.selectedTaxItems.indexOf($scope.added_tax_types[index].name);
        $scope.selectedTaxItems.splice(selected_index, 1);
        $scope.added_tax_types.splice(index, 1);
        $scope.updateInvoiceTotal();
    };
});