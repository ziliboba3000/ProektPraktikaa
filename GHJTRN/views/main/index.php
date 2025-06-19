<?php 
    if (count($_COOKIE) < 1) {
        header('Location: /main/login.php');
        exit;
    }else {echo 'cookie are enabled';
    }
    $info = $this->user;
    $this->user = USER::getByLogin($info);
    ?>

<main>
    <p>Здравствуйте <?= $this->user['second_name'];?> <?=$this->user['first_name'];?> <?=$this->user['third_name']?>.</p>
    <h1>На вашем счёте на данный момент <?=$this->user['cash']?>р.</h1>
</main>


<form id='logout-form'>
    <button>Выйти</button>
</form>


<script type='text/javascript'>
    document.getElementById('logout-form').onsubmit = e => {
    e.preventDefault();
    e.stopImmediatePropagation();

    const FD = new FormData(e.currentTarget);
    fetch(`${window.location.origin}/api/user/logOutThroughPassword`, { method: 'POST', body: FD })
    
        .then(res => { return res.json() })
        .then(json => { console.log(json) })
    
        setTimeout(() => window.location.reload(), 80)

    }

</script>
</html>