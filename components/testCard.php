<?php
function testCard($testName, $description, $redirectLink)
{
?>

    <div class="col-md-4">
        <div class="department-wrap p-4 ftco-animate">
            <div class="text p-2 text-center">
                <div class="icon">
                    <span class="flaticon-stethoscope"></span>
                </div>
                <h3><a href="<?= $redirectLink ?>"><?= $testName ?></a></h3>
                <p><?= $description ?></p>
            </div>
        </div>
    </div>


<?php
}
?>