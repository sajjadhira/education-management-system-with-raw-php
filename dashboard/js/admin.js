$(document).ready(function(){
$(document).on('change', '#class', function() {
            var class = this.value;
	        var t = "action=getsection&class="+ class;
				$.ajax({
                type: "POST",
                url: "/dashboard/get.php",
                data: t,
                cache: !1,
                success: function(e) {
				$("#getsectionfromclass").html(e);
				}
			});
}),
$(document).on('change', '#subcategory', function() {
            var id = this.value;
	        var t = "action=childcategory&id="+ id;
				$.ajax({
                type: "POST",
                url: "/dashboard/get.php",
                data: t,
                cache: !1,
                success: function(e) {
				$("#getchildcategory").html(e);
				}
			});
}),
$(document).on('click', '#addProdcutSubmit', function() {
if ($("#productname").val().length==0)
{
$("#productnameAlert").html("Please type product name!");
$("#productname").focus();
return false;
}
else
{
$("#productnameAlert").html(null);
}
if ($("#brand").val().length==0)
{
$("#brandAlert").html("Please type product brand name!");
$("#brand").focus();
return false;
}
else
{
$("#brandAlert").html(null);
}
if ($("#category").val().length==0)
{
$("#categoryAlert").html("You must select a category!");
$("#category").focus();
return false;
}
else
{
$("#categoryAlert").html(null);
}
if ($("#subcategory").val().length==0)
{
$("#subcategoryAlert").html("You must select a sub-category!");
$("#subcategory").focus();
return false;
}
else
{
$("#subcategoryAlert").html(null);
}
if ($("#childcategory").val().length==0)
{
$("#childcategoryAlert").html("You must select a child-category!");
$("#childcategory").focus();
return false;
}
else
{
$("#childcategoryAlert").html(null);
}
if ($("#description").val().length==0)
{
$("#descriptionAlert").html("Please type product description!");
$("#description").focus();
return false;
}
else
{
$("#descriptionAlert").html(null);
}
$("#addProductForm").submit();
// return true;
})
});