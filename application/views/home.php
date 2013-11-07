<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Web Store Front</title>
    <script  src="js/jquery-min.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="container">
      <form action="" method="post">
      	<label style="display:block" for="pdt_auto">Please start typing in the text box below for suggestions</label>
      	<input id="pdt_auto" name="product" type="text" placeholder="Start typing here" size="100"/>
      </form>
    </div>
    <div class="container" id="auto_holder">
    </div>
    <script type="text/javascript">
		$(function(){
			var $input = $('#pdt_auto')
			,$results = $('#auto_holder')
			,ajaxCall = null
			,prev = '';

			$input.bind('keyup',keyevents);

			$($input[0].form).submit(function(e){e.preventDefault();});
			
			function keyevents(e) {
				var v = $input.val();
				
				if (v == prev) return;
				
				if(ajaxCall) ajaxCall.abort();
				if (v.length >= 3) {
					requestData(v);
				} else {
					$results.html('');
				}
			}

			function requestData(q) {
				ajaxCall = $.ajax({
					url: 'productsAutoSuggest'
					,dataType:"json"
					,type: "post"
					,data: {str : q}
				})
				.done(function(d) { 
					receiveData(q, d);
				})
				.fail(function(f) {
				});
			}

			function receiveData(q, data) {
				if (data) {
					$results.html('');

					for(var x in data){
						if(!data.hasOwnProperty(x))continue;
						$results.append('<div><a href="'+data[x].url+'">'+data[x].name+'</a></div>');
					}
				} else {
					$results.html('');
				}
			};
		});
    </script>
  </body>
</html>
