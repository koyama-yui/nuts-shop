<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="image/slick/slick.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="image/slick/slick-theme.css" media="screen" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="image/slick/slick.min.js"></script>
  <style>
    img{max-width:100%;height:auto;}
  </style>
</head>
<body>
  

<div class="multiple-item">
<?php  for ($i=1; $i < 12; $i++) {  ?>
    <div><img src="image/<?=$i?>.jpg"></div>
<?php  } ?>    
</div>

<script>
  $(function() {
    $('.multiple-item').slick({
      infinite: true,
      dots:true,
      slidesToShow: 4,
      slidesToScroll: 2,
      centerMode: true, //要素を中央寄せ
      autoplay:true, //自動再生
      responsive: [{
        breakpoint: 768,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
        }
  },{
        breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        }
      ]
     });
});
</script>

</body>
</html>