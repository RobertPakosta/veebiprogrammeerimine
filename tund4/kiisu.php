<?php	
    require('functions.php');
    $title = 'Kiisud';
    $success = false;
    $error = false;
    $name = $color = ''; 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            $error = "Palun sisesta kassi nimi";
        } else {
            $name = cleanInput($_POST['name']);
        }
        if (!isset($_POST['color']) || empty($_POST['color'])) {
            $error = "Palun sisesta kassi värv!";
        } else {
            $color = cleanInput($_POST['color']);
        }
        if (!isset($_POST['tail']) || empty($_POST['tail'])) {
            $error = "Palun sisesta saba pikkus!";
        } else if (!filter_var($_POST['tail'], FILTER_VALIDATE_INT)) {
            $error = "Saba pikkus peab olema arv!";
        } else {
            $tail = intval($_POST['tail']);
            if ($tail <= 0) {
                $error = "Saba pikkus peab olema 0'st suurem arv!";
            }
        }
        if (!$error) {
            if (saveCat($name, $color, $tail)) {
                $success = true;
            } else {
                $error = "Kassi salvestamine ebaõnnestus!";
            }
        }   
    }
?>

	<div class="container mt-4">
		<div class="row">
			<div class="col">
				<div class="center">
					<h2>Lisa kass</h2>
				</div>
				<hr>
                <?php
                    if ($error) {
                        echo alert($error, 'danger');
                    } else if ($success) {
                        echo alert('Kass salvestatud edukalt', 'success');
                    }
                ?>
				<form method="post">
					<div class="form-group">
						<label for="inputName">Kassi nimi</label>
						<input type="text" class="form-control" name="name" id="inputName" placeholder="Sisesta kassi nimi" value="<?php echo $name; ?>" required>
					</div>
					<div class="form-group">
						<label for="inputName">Kassi värv</label>
						<input type="text" class="form-control" name="color" id="inputColor" placeholder="Sisesta kassi värv" value="<?php echo $color; ?>" required>
					</div>
					<div class="form-group">
						<label for="inputName">Kassi saba pikkus</label>
						<input type="number" class="form-control" name="tail" id="inputTail" placeholder="Sisesta saba pikkus" value="<?php echo $tail; ?>" required>
					</div>
					<button type="submit" class="btn btn-primary">Lisa kass</button>
				</form>
			</div>
            <div class="col">
                <div class="center">
                    <h2>Lisatud kassid</h2>
				</div>
				<hr>
				<div class="list-group">
                </div>
			</div>
		</div>

	</div>