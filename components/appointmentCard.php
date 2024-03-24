<?php
function appointmentCard($name, $date, $time, )
{
?>

    <div class=" card shadow-lg my-3">
        <div class="card-body">
            <div class="row specialty general-surgery">
                <div class="col-lg-7">
                    <h3> <a href=""><?= $name ?></a> </h3>
                </div>
                <div class="col-lg-5">
                    <div class="list-group list-group-flush">
                        <a href="" class="list-group-item list-group-item-action">
                            <span style="font-weight: 600;">Date -</span> <?= $date ?> | <span style="font-weight: 600;">Time - </span><?= $time ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
}
?>