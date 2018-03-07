$(document).ready(function(){
    // ajax call to get the data for JS tree
    var ajaxResponse = '';
    $.ajax({
    	url 	: '../ajax/modulos_permisos.php?op=listar_permisos_x_modulo',
    	async  : false,
    	success : function(response)
    	{
    		ajaxResponse = response;
    	}
    });

    // render js tree
    var tree = $("#container");
    tree.html(ajaxResponse);
    tree.jstree({
         //plugins: ["checkbox" ], 
        //["wholerow", "checkbox", "json_data", "ui", "themes"]
        plugins: ["wholerow", "checkbox", "json_data", "ui", "themes"],
        'checkbox': {
            three_state: false,
            cascade: 'up'
        }
    });
    tree.jstree(true).open_all();
    $('li[data-checkstate="checked"]').each(function() {
        tree.jstree('check_node', $(this));
    });
    tree.jstree(true).close_all();

    // get all the selected nodes
    $('#btn').click(function(){
        var selectedRole = $('#user_role_id').val();
        var selectedPermissions = [];
        var selectedElms = $('#container').jstree("get_selected", true);
            $.each(selectedElms, function() {
                selectedPermissions.push(this.id);
        });
        
        console.log(selectedPermissions);
    });
});