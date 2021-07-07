$('#tag_list').select2({
    tags: true,
    tokenSeparators: [',', ' '],
    placeholder: "Choose tags...",
    minimumInputLength: 2,
    ajax: {
        url: '/tags/find',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});
