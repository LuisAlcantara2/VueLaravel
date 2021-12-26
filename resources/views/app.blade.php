<!DOCTYPE html>
<html lang="{{str_replace('_','-',app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Abarrotes Kristel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="{{ mix('css/app.css')}}" type="text/css">

</head>
<body>
    <div id="app">

    </div>
    <script src="{{mix('js/app.js')}}" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vuetify/2.6.1/vuetify.min.js" integrity="sha512-RiKl5hR3ePSZwVw8g98fZYam4zx6LxcS0yySVqlPxnXc0TKdcSIO8sm9ATFDwxpqEaqIIGxD4d0UZZxxzcduyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>