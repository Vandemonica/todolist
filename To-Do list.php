<?php $con = mysqli_connect("localhost","root","","someDb");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #f2f2f2;
        }
        .center{
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #1b1b1b;
            border-radius: 5px;
        }
        .center .tombol{
            width: 350px;
            background: #1b1b1b;
            height: 50px;
            padding: 0 20px;
            border-radius: 5px 5px 0 0 ;
        }
        .tombol .teks{
            font-size: 25px;
            line-height:50px ;
            font-weight: 600;
            font-family: 'Open Sans',sans-serif;
        }
        .tombol .ikon{
            font-size: 30px;
            float: right;
            line-height: 40px;
            cursor: pointer;

        }
        .center .field{
            height: 45px;
            width: 350px;
            background:#f2f2f2;
            position: relative;
            display: block;
        }
        .field.hide{
            display: none;
        }
        .field input{
            height: 100%;
            width: 100%;
            padding-left: 15px;
            font-size: 18px;
            outline: none;
            background: none;
            color: #202020;
            border: 2px solid #1b1b1b;
        }
        .field .masukan{
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: #1b1b1b;
            font-size: 18px;
            font-family: 'Montserrat',sans-serif;
            border-radius: 3px;
            cursor: pointer;
            display: none;
        }
        input:valid ~ .masukan{
            display: block;
        }
        .center ul{
            list-style: none;
            overflow: hidden;
        }
        ul li{
            height: 45px;
            width: 100%;
            line-height: 45px;
            background: #262626;
            font-family: 'Noto Sans',sans-serif;
        }
        ul li:nth-child(2n){
            background:#1b1b1b;
        }
        ul li:last-child{
            border-radius: 0 0 5px 5px;
        }
        ul li:last-child span{
            border-radius: 0 5px 5px 0;
        }
        ul li span{
            margin-right: 20px;
            height: 45px;
            width: 45px;
            background: #e74c3c;
            display: inline-block;
            line-height: 45px;
            text-align: center;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
            margin-left: -45px;
            transition: 0.3s ease;
        }
        ul li:hover span{
            margin-left: 0px;
        }
        .masukBtn{
            background-color: transparent;
            font-size: 18px;
            font-family: 'Montserrat',sans-serif;
            border: none;
            height: auto;
            width: auto;
            padding: 4px 8px;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="shortcut icon" type="image/png" href="pict/logo 1.2.png">
    <title>To-Do List</title>
</head>
<body>
    <div class="center">
        <div class="tombol">
            <span class="teks">Daftar </span>
            <span class="ikon"> <i class="fas fa-sort-down"></i></span>
        </div>
<!-------------jika tombol ditekan(aktif) maka insert--------------------------------------------->
        <form method="post">
            <?php
            if(isset($_POST["masuk"])){
                $list = $_POST["input"];
                mysqli_query($con,"INSERT INTO listtb(id,isi_list) VALUES(null,'$list')");
            }
            ?>
        <div class="field">
            <input type="text" name="input" placeholder="Masukkan daftar yang akan dilakukan">
            <span class="masukan">
                <button type="submit" onclick="tertambahkan()" class="masukBtn" name="masuk">Masukkan</button>
            </span>
        </div>
        <ul>
        </form>
<!-----------------------query dan looping fetch-------------------------------------------------->
        <form method="GET">
            <?php
            $selectFromTb = mysqli_query($con,"SELECT * FROM listTb ORDER BY id DESC");
            while($fetch = mysqli_fetch_assoc($selectFromTb)):?>
<!-------------------------panggil fetch---------------------------------------------------------->
                <li>
                    <span>
                        <a style="text-decoration: none;" href="delete.php?id=<?=$fetch['id']?>">
                            <i class="fas fa-trash"></i>
                        </a>
                    </span><?=$fetch["isi_list"];?>
                </li>
            <?php endwhile;?>
        </form>
<!------------------------------------------------------------------------------------------------>
        </ul>
    </div>
    <script>
        $('.masukan').click(function(){
            $('ul').append("<li><span><i class='fas fa-trash'></i></span>" + $('input').val() + "</li>");
            //$('input').val(""); <--- this pecking piss of sheet cause input field to be null
        });
        $('ul').on("click", 'span', function(){
            $(this).parent().fadeOut(500,function(){
                $(this).remove();
            });
        });
        $('.ikon').click(function(){
            $('.field').toggleClass("hide");
        });
        function tertambahkan() {
            Swal.fire({
                position: 'top-start',
                icon: 'success',
                title: 'List Telah Ditambahkan',
                showConfirmButton: false,
                timer: 1200
            })
        }
    </script>
</body>
</html>
