<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Online Library</title>
    @if (session('error'))
      <div id="liveAlertPlaceholder"></div>
      <script>
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
        const appendAlert = (message, type) => {
          const wrapper = document.createElement('div')
          wrapper.innerHTML = [
          `<div class="alert alert-${type} alert-dismissible" role="alert">`,
          `   <div>${message}</div>`,
          '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
          ].join('')
  
          alertPlaceholder.append(wrapper)
        }

        const alertTrigger = 1

        if(alertTrigger){
          appendAlert('Not Authorized to access page!', 'alert alert-danger')
        }
  
      </script>
    @endif
    
</head>
<body>
  
    @include('layouts.navbar')
    
    <h1 class="pt-5 text-center">Welcome to Online Library</h1>
    {{-- <a href="/books">See Available Books</a><br><br> --}}
    
    
    {{-- <a href="/books/create">Add a New Book</a><br><br> --}}
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</body>
</html>