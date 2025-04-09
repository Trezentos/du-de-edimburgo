<?php
    $items = [
        [
            'icon' => IMG.'icons/security-icons/energy.svg',
            'text' => 'Energia <br> elétrica <br>subterrânea',
        ],
        [
            'icon' => IMG.'icons/security-icons/post.svg',
            'text' => 'Rede de energia <br> e iluminação <br> pública LED',
        ],
        [
            'icon' => IMG.'icons/security-icons/pipe.svg',
            'text' => 'Infraestrutura <br> para teleco-<br>municação',
        ],
        [
            'icon' => IMG.'icons/security-icons/rede-dren.svg',
            'text' => 'Rede de <br> drenagem <br>pluvial',
        ],
        [
            'icon' => IMG.'icons/security-icons/faucet.svg',
            'text' => 'Rede de <br> abastecimento e <br> distribuição de <br> água potável',
        ],
        [
            'icon' => IMG.'icons/security-icons/grid.svg',
            'text' => 'Pavimentação<br> moderna <br> em paver',
        ],
        [
            'icon' => IMG.'icons/security-icons/plate.svg',
            'text' => 'Sinalização <br> vertical e <br>horizontal',
        ],
        [
            'icon' => IMG.'icons/security-icons/pipe-2.svg',
            'text' => 'Rede de coleta <br> de esgoto',
        ],
        [
            'icon' => IMG.'icons/security-icons/middle-wire.svg',
            'text' => 'Meio-fio<br> contínuo estilo <br>americano',
        ],

    ]


?>


<div class="security-items waypoint animation_bottom">
    <?php  foreach ($items as $item):?>
        <div class="security-item">
            <img src="<?=$item['icon']?>" alt="">
            <p class="small mt20 mt40-mobile"><?=$item['text']?></p>
        </div>
    <?php endforeach; ?>
</div>
