var btn = document.getElementById('btn');
var ft_list = document.getElementById('ft_list');

getTodos();

btn.addEventListener('click', function (){
	var todo = prompt('New to-do');

	if (todo != "") {
		addToDo(todo);
}
});

ft_list.addEventListener('click', function (e) {
	var cookies = getCookie('todo').split('~');
	var todo = e.toElement.textContent;

	
	if (confirm('Delete?'))
	{
		this.removeChild(e.target);

		for (index in cookies)
		{
			if (cookies[index] == todo)
				cookies.splice(index, 1)
		}
		setCookie('todo', cookies.join('~'), 30);
	}
});

function addToDo(todo)
{
	var list = document.getElementById('ft_list');
	var node = document.createElement('div');
	var cookies = new Array();

	node.innerHTML = todo;
	list.insertBefore(node, list.childNodes[0]);

	cookies = getCookie('todo').split('~');
	if (cookies == "")
		cookies[0] = todo;	
	else
		cookies.push(todo);
	setCookie('todo', cookies.join('~'), 30);
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ')
        	c = c.substring(1);
        if (c.indexOf(name) == 0)
        	return c.substring(name.length,c.length);
    }
    return "";
}

function getTodos()
{
	cookies = getCookie('todo').split('~');
	var list = document.getElementById('ft_list');

	if (cookies != "")
	{
		for (index in cookies) {
			var node = document.createElement('div');

			node.innerHTML = cookies[cookies.length - index - 1];
			list.appendChild(node);
		}
	}
}