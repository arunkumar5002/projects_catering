<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dropdown Matching</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<!-- Sample dropdown lists -->
<select id="dd_1">
  <option value="1">Option 1</option>
  <option value="2">Option 2</option>
  <option value="3">Option 3</option>
</select>

<select id="dd_2">
  <option value="1">Option 1</option>
  <option value="2">Option 2</option>
  <option value="3">Option 3</option>
</select>

<select id="dd_3">
  <option value="1">Option 1</option>
  <option value="2">Option 2</option>
  <option value="3">Option 3</option>
</select>

<!-- jQuery script -->
<script>
$(document).ready(function(){
  // Array of values
  var jQueryValues = ['1', '3', '3']; // Example values, you can change this
  
  // Loop through each dropdown
//   for (var i = 1; i <= 3; i++) {
//     // Set the matched value as selected
//     $("#dd_" + i).val(jQueryValues[i - 1]);
//   }

// $.each(jQueryValues, function(index, value) {
//   for (var i = 1; i <= 3; i++) {
//     // Set the matched value as selected
//     $("#dd_" + i).val(value[i - 1]);
//   }
// });

$.each(jQueryValues, function(index, obj) {
  var id = obj.id;
  for (var i = 1; i <= Math.min(3, id.length); i++) {
    // Set the matched value as selected
    $("#dd_" + i).val(id.charAt(i - 1));
  }
});


});
</script>

</body>
</html>
