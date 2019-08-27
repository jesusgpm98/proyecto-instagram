var url = 'http://localhost:8888/proyecto-instagram/public/';
//var url = 'http://localhost/proyecto-instagram/public/';

window.addEventListener("load", function(){
  //poner manito al cursor para darle click
  $('.btn-like').css('cursor', 'pointer');
  $('.btn-dislike').css('cursor', 'pointer');
  $('.pointer').css('cursor', 'pointer');

  //boton de like
  function like(){
    $('.btn-like').unbind('click').click(function(){
      console.log('like');
      $(this).addClass('btn-dislike').removeClass('.btn-like');
      // $(this).attr('class','heart-red');
      $(this).toggleClass('fas fa-heart heart-red fas-lg').removeClass('fas fa-heart-o fas-lg');

      $.ajax({
        url: url+'/like/'+$(this).data('id'),
        type: 'GET',
        success: function(response){
          if(response.like){
            location.reload();
            console.log('has dado like');
          }else{
            console.log('error like');
          }
        }
      });

      dislike();
    });
  }
  like();

  //boton de dislike
  function dislike(){
    $('.btn-dislike').unbind('click').click(function(){
      console.log('dislikeee');
      $(this).addClass('btn-like').removeClass('.btn-dislike');
      $(this).toggleClass('fas fa-heart-o fas-lg').removeClass('fas fa-heart heart-red fas-lg');

      $.ajax({
        url: url+'/dislike/'+$(this).data('id'),
        type: 'GET',
        success: function(response){
          if(response.like){
            location.reload();
            console.log('has dado dislike');
          }else{
            location.reload();
            console.log('error dislike');
          }
        }
      });

      like();
    });
  }
  dislike();

  //buscador
  $('#buscador').submit(function(){
    $(this).attr('action',url+'users/' + $('#buscador #search').val());
    $(this).submit();

  });

});
