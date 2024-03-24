<?php
function reportCard($name, $date, $time, $link)
{
?>

    <div class=" card shadow-lg my-3">
        <div class="card-body">
            <div class="row specialty general-surgery">
                <div class="col-lg-4">
                    <h3> <a href=""><?= $name ?></a> </h3>
                </div>
                <div class="col-lg-6">
                    <div class="list-group list-group-flush">
                        <a href="" class="list-group-item list-group-item-action">
                            <span style="font-weight: 600;">Date -</span> <?= $date ?> | <span style="font-weight: 600;">Time - </span><?= $time ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="list-group text-center list-group-flush">
                        <a href="../medLabs/admin/dbh/<?= $link ?>" download="<?= $link ?>" class="list-group-item list-group-item-action btn btn-primary" style="border-radius: 10px;">
                            Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
}
?>