$('#delete').click(function(){
    var checkbox = $('.delete-checkbox:checked');
    if(checkbox.length > 0)
    {
        var checkbox_value = [];
        $(checkbox).each(function(){
            checkbox_value.push($(this).val());
        });

        $.ajax({
            url: "http://127.0.0.1/scandiweb/src/backend/Classes/DeleteProducts.php",
            method:"POST",
            data:{pro:checkbox_value}
        });
    }
    else
    {
        alert("Select at least one record to delete.");
    }
});