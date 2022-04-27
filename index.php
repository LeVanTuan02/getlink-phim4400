<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Link Phim4400</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="container">
        <div class="panel">
            <div class="panel__heading">
                <h3 class="panel__title">Get Link 
                    <a href="https://xemphimnao.com/" target="_blank">Phim4400</a>
                </h3>
            </div>

            <div class="panel__body">
                <form action="" class="panel__form" onsubmit="return false;">
                    <button class="panel__form-icon">
                        <i class="fas fa-terminal"></i>
                    </button>
                    <div class="panel__form-control">
                        <input type="text" name="url" placeholder="Nhập link phim, VD: https://xemphimnao.com/tro-choi-con-muc-tap-123-squid-game-season-1/" class="form-input">
                    </div>
                    <div class="panel__form-btn">
                        <input type="submit" value="Get link">
                        <div class="panel__form-btn-icon">
                            <i class="fas fa-arrow-circle-right"></i>
                        </div>
                    </div>

                </form>

                <div class="alert alert-danger hidden">Vui lòng nhập URL phim</div>
                <div class="panel__loading-box hidden">
                    <img src="https://i.stack.imgur.com/kOnzy.gif" alt="">
                </div>

                <div class="panel__box-film">
                    <ul class="panel__box-film-tab hidden">
                        <li class="panel__box-film-tab-item active">Server 1</li>
                        <li class="panel__box-film-tab-item">Server 2</li>
                        <li class="panel__box-film-tab-item">Server 3</li>
                        <li class="panel__box-film-tab-item">Server 4</li>
                    </ul>
                    <div class="panel__box-film-content"></div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <span>
                Copyright by
                <a href="https://www.facebook.com/LeVanTuan.Info/" class="footer__link" target="_blank">Lê Văn Tuân</a>
                © 2021
            </span>
        </footer>
    </div>
    
    <script>
        $('.panel__form-btn').on('click', function(){
            $link = $('.form-input').val();
            $('.panel__box-film').addClass('hidden');
            $('.panel__body .alert').addClass('hidden');
            if(!$link){
                $('.panel__body .alert').removeClass('hidden');
            }else{
                $('.panel__loading-box').removeClass('hidden');
                $.ajax({
                    url: 'api.php',
                    method: 'POST',
                    data: {
                        url: $link
                    },
                    success: function(data){
                        if(data){
                            $data_film = JSON.parse(data);
                            $html = '';
    
                            $.each($data_film, function(key, value){
                                if(key == 0){
                                    $html += `<iframe width="100%" class="active" height="400px" src="${value}" frameborder="0" allowfullscreen></iframe>`;
                                }else{
                                    $html += `<iframe width="100%" height="400px" src="${value}" frameborder="0" allowfullscreen></iframe>`;
                                }
                            })
    
                            $('.panel__loading-box').addClass('hidden');
                            $('.panel__box-film').removeClass('hidden');
                            $('.panel__box-film-tab').removeClass('hidden');
                            $('.panel__box-film-content').html($html);
    
                            const tab = document.querySelectorAll('.panel__box-film-tab-item');
                            const contentList = document.querySelectorAll('.panel__box-film-content iframe');
    
                            Array.from(tab).forEach((item, index) => {
                                const content = contentList[index];
                                console.log(content);
                                item.onclick = function() {
                                    document.querySelector('.panel__box-film-tab-item.active').classList.remove('active');
                                    document.querySelector('iframe.active').classList.remove('active');
                                    
                                    this.classList.add('active');
                                    content.classList.add('active');
                                }
                            })
                        }else{
                            $('.panel__loading-box').addClass('hidden');
                            $('.panel__body .alert').text('Vui lòng nhập Url hợp lệ!');
                            $('.panel__body .alert').removeClass('hidden');
                        }
                    },
                    error: function(){
                        console.log('có lỗi');
                    }
                });

                

            }
        });
    </script>
</body>
</html>