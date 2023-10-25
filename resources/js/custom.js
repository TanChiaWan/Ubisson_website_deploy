$(document).ready(function() {
    getOrganization();

    function getOrganization() {
        $("#organization").html("");
        $.ajax({
            url: "/get-organization",
            type: "GET",
            success: function(result) {
                $.each(result.data, function(key, value) {
                    $("#organization").append('<option value="' + value.id + '">' + value.organization + "</option>");
                });
            },
        });
    }

    $("#organization").on("change", function() {
        var organizationId = this.value;
        $("#roles").html("");
        $.ajax({
            url: "/get-roles",
            type: "POST",
            data: {
                organization_id: organizationId,
                _token: "{{ csrf_token() }}",
            },
            dataType: "json",
            success: function(result) {
                $.each(result.data, function(key, value) {
                    $("#roles").append('<option value="' + value.id + '">' + value.role + "</option>");
                });
                $("#permissions").html('<option value="">Select Role First</option>');
            },
        });
    });

    $("#roles").on("change", function() {
        var organizationId = $("#organization").val();
        var roleId = this.value;
        $("#permissions").html("");
        $.ajax({
            url: "/get-permissions",
            type: "POST",
            data: {
                organization_id: organizationId,
                role_id: roleId,
                _token: "{{ csrf_token() }}",
            },
            dataType: "json",
            success: function(result) {
                $.each(result.data, function(key, value) {
                    $("#permissions").append('<option value="' + value.id + '">' + value.permission + "</option>");
                });
            },
        });
    });
});