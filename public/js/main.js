$(document).ready(function () {

    $("#users-list").DataTable({
        "iDisplayLength": 50
    });
});

$('#deleteLink').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes
    var descr = button.data('descr'); // Extract info from data-* attributes
    var modal = $(this);

    modal.find('#delete').attr('href', main_route + 'admin/links/' + id + '/delete');
    modal.find('.modal-body').text(descr);
});

$('#deleteCategory').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes
    var descr = button.data('descr'); // Extract info from data-* attributes
    var modal = $(this);

    modal.find('#delete').attr('href', main_route + 'admin/categories/' + id + '/delete');
    modal.find('.modal-body').text(descr);
});

$('#deleteUser').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes
    var email = button.data('email'); // Extract info from data-* attributes
    var modal = $(this);

    modal.find('#delete').attr('href', main_route + 'admin/users/' + id + '/delete');
    modal.find('.modal-body').text(email);
});