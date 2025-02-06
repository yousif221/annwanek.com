$(document).ready(function () {
    domainIndex = new Vue({
        el: '#domain-index',
        data: {
            domainList: [],
            show: false,
            displayError: false,
            errorMessage: ''
        },
        methods: {
            search: function () {
                Codebase.layout('header_loader_on');
                domainIndex.show = false;
                let  form = $('#check-availability');
                let  url = form.attr('action');
                domainIndex.displayError = false;
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: form.serialize(),
                    success: function (data) {
                        if(data.status) {
                            domainIndex.show = true;
                            domainIndex.domainList = data.data;
                        }
                        else {
                            domainIndex.displayError = true;
                            domainIndex.errorMessage = data.message;
                        }
                        Codebase.layout('header_loader_off');
                    }
                });
            },
        }
    });
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});
