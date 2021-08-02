<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Item Manager</title>
        <link rel="stylesheet" href="https://bootswatch.com/5/simplex/bootstrap.min.css">

    </head>
    
    <body>
    
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                  <a class="navbar-brand" href="/">Item Manager</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav me-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href="/">Home
                          <span class="visually-hidden">(current)</span>
                        </a>
                      </li>
                      <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                      </li> -->
                    </ul>
                    <!-- <form class="d-flex">
                      <input class="form-control me-sm-2" type="text" placeholder="Search">
                      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form> -->
                  </div>
                </div>
              </nav>

              <div class="container mt-2">
              	  <h1>Add Item</h1>
              	  <form id="itemForm">
              	  	  <div class="form-group">
              	  	  	  <label>Text</label>
              	  	  	  <input type="text" id="text" class="form-control">
              	  	  </div>
              	  	  <div class="form-group">
              	  	  	  <label>Body</label>
              	  	  	  <textarea id="body" class="form-control"></textarea>
              	  	  </div>
              	  	  <input type="submit" value="Submit" class="btn btn-primary mt-2">
              	  </form>
              	  <hr>
              	  <ul id="items" class="list-group"></ul>
              </div>

        <script
            src="https://code.jquery.com/jquery-1.12.4.js"
            integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
            crossorigin="anonymous">
        </script>	

        <script type="text/javascript">
        	$(document).ready(function() {
        		getItems();

        		// Submit event
                $('#itemForm').on('submit', function(e) {
                    e.preventDefault();

                    let text = $('#text').val();
                    let body = $('#body').val();

                    addItem(text, body)
                });

                // Delete item event
                $('body').on('click', '.deleteLink', function(e) {
                    e.preventDefault();
                    
                    let id = $(this).data('id');

                    deleteItem(id);
                });

                // Delete item using api
                function deleteItem(id) {
                	$.ajax({
                		method:'POST',
                        url:'http://itemmanager.local/api/items/'+id,
                        data: {_method: 'DELETE'}
                    }).done(function(item) {
                        alert('Item Removed');
                        location.reload();
                    });
                }

                // Insert item using api
                function addItem(text, body) {
                	$.ajax({
                		method:'POST',
                        url:'http://itemmanager.local/api/items',
                        data: {text: text, body: body}
                    }).done(function(item) {
                        alert('Item Added');
                        location.reload();
                    });
                }

        		// Get items from API
                function getItems() {
                    $.ajax({
                        url:'http://itemmanager.local/api/items'
                    }).done(function(items) {
                        let output = '';
                        $.each(items, function(key, item) {
                        	output += `
                        	<li class="list-group-item">
                                <strong>${item.text}: </strong>${item.body} <a href="#" class="deleteLink" data-id="${item.id}">Delete</a>
                        	</li>
                        	`;
                        });
                        $('#items').append(output);
                    });
                }
        	});
        </script>
    </body>
</html>