[include]app/views/base.view.php[/include]
<h1>Test</h1>
<br>
My name is: {{ir['username']}}<br>
For Loop 1
<br>
@for i in range(1,5)
	Line: {{i}}<br>
@endfor
<br>
For Loop 2
<br>
@for i in range(5)
	Line: {{i}}<br>
@endfor
<br>
For Loop 3
<br>
@for i in range(1,10,2)
	Line: {{i}}<br>
@endfor
<br>
Reading from cache: {{cVal}} <br>
CSRF TOKEN: {{CSRF}} <br>
<form action='' method='post'>
{{CSRFFORM}}<br>
Username: <input type='text' name='username'>
<br>
<input type='submit'>
</form>
<br>
Domain: {{domain}}<br>
PreviousPage: {{previousPage}}<br>
[include]app/views/footer.view.php[/include]