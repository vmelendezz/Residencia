<?php 
	
	function nombre( $data ){
		return preg_match("/^[A-Za-z0-9_-\á\é\í\ó\ú\Á\É\Í\Ó\Ú\ñ\Ñ ]{3,45}$/", $data);
	}

	if (isset($_GET["action"]) && $_GET["action"] == "getProgramas") {
		require "../modelo/getInitProgramas.php";
		$initProgramas = new Programas();

		if( $_GET['tipoModalidad'] == 'lineaInvestigacion' ){
			echo json_encode ( $initProgramas ->getProgramas());
		}else if( $_GET['tipoModalidad'] == 'lineaCuerpoAcademico' ){
			echo json_encode ( $initProgramas ->getProgramasCuerpoacademico());
		}else if( $_GET['tipoModalidad'] == 'procesoConsolidacion' ){
			echo json_encode ( $initProgramas ->getProgramasProcesoConsolidacion());
		}
	}else if (isset($_POST["action"]) && $_POST["action"] == "eliminarPrograma") {
		require "../modelo/getInitProgramas.php";
		if( $_POST['tipoModalidad'] == 'lineaInvestigacion' ){
			$eliminar = new Programas();

			echo json_encode ( $eliminar->eliminarProgramaLinea($_POST['id']));
		}else if( $_POST['tipoModalidad'] == 'lineaCuerpoAcademico' ){
			$eliminar = new Programas();

			echo json_encode ( $eliminar->eliminarProgramaCuerpoAcademico($_POST['id']));
		}else if( $_POST['tipoModalidad'] == 'procesoConsolidacion' ){
			$eliminar = new Programas();

			echo json_encode ( $eliminar->eliminarProcesoConsolidacion($_POST['id']));
		}
	}else if (isset($_POST["action"]) && $_POST["action"] == "modificarPrograma") {
		require "../modelo/getInitProgramas.php";
		if( $_POST['tipoModalidad'] == 'lineaInvestigacion' ){
			if( !empty($_POST['nombre']) &&  $_POST['nombre'] != 'null' ){
				if( nombre($_POST['nombre']) ){
					$actualizar = new Programas();
					echo json_encode ( $actualizar ->actualizarProgramaLinea($_POST['id'], $_POST['nombre']));
				}else{
					$result['response'] = 'Minimo deben ser 3 letras y maximo 45, debe contener letras, numeros o _, -';
					echo json_encode ( $result['response'] );
				}
			}else{
				$result['response'] = 'Campo no puede estar vacio';
				echo json_encode ( $result['response'] );
			}
		}else if( $_POST['tipoModalidad'] == 'lineaCuerpoAcademico' ){
			if( !empty($_POST['nombre']) &&  $_POST['nombre'] != 'null' ){
				if( nombre($_POST['nombre']) ){
					$actualizar = new Programas();
					echo json_encode ( $actualizar ->actualizarProgramaCuerpoAcademico($_POST['id'], $_POST['nombre']));
				}else{
					$result['response'] = 'Minimo deben ser 3 letras y maximo 45, debe contener letras, numeros o _, -';
					echo json_encode ( $result['response'] );
				}
			}else{
				$result['response'] = 'Campo no puede estar vacio';
				echo json_encode ( $result['response'] );
			}
		}else if( $_POST['tipoModalidad'] == 'procesoConsolidacion' ){
			if( !empty($_POST['nombre']) &&  $_POST['nombre'] != 'null' ){
				if( nombre($_POST['nombre']) ){
					$actualizar = new Programas();
					echo json_encode ( $actualizar ->actualizarProcesoConsolidacion($_POST['id'], $_POST['nombre']));
				}else{
					$result['response'] = 'Minimo deben ser 3 letras y maximo 45, debe contener letras, numeros o _, -';
					echo json_encode ( $result['response'] );
				}
			}else{
				$result['response'] = 'Campo no puede estar vacio';
				echo json_encode ( $result['response'] );
			}
		}
	}else if (isset($_POST["action"]) && $_POST["action"] == "addPrograma") {
		require "../modelo/getInitProgramas.php";
		if( $_POST['tipoModalidad'] == 'lineaInvestigacion' ){

			if( !empty($_POST['nombre']) &&  $_POST['nombre'] != 'null'  ){
				if( nombre($_POST['nombre']) ){
					$actualizar = new Programas();
					echo json_encode ( $actualizar->addProgramas($_POST['nombre']));
				}else{
					$result['response'] = 'Minimo deben ser 3 letras y maximo 45, debe contener letras, numeros o _, -';
					echo json_encode ( $result['response'] );
				}
			}else{
				$result['response'] = 'Campo no puede estar vacio';
				echo json_encode ( $result['response'] );
			}
			
		}else if( $_POST['tipoModalidad'] == 'lineaCuerpoAcademico' ){

			if( !empty($_POST['nombre']) &&  $_POST['nombre'] != 'null'  ){
				if( nombre($_POST['nombre']) ){
					$actualizar = new Programas();
					echo json_encode ( $actualizar->addProgramasCuerpoAcademico($_POST['nombre']));
				}else{
					$result['response'] = 'Minimo deben ser 3 letras y maximo 45, debe contener letras, numeros o _, -';
					echo json_encode ( $result['response'] );
				}
			}else{
				$result['response'] = 'Campo no puede estar vacio';
				echo json_encode ( $result['response'] );
			}
			
		}else if( $_POST['tipoModalidad'] == 'procesoConsolidacion' ){

			if( !empty($_POST['nombre']) &&  $_POST['nombre'] != 'null'  ){
				if( nombre($_POST['nombre']) ){
					$actualizar = new Programas();
					echo json_encode ( $actualizar->addProcesoConsolidacion($_POST['nombre']));
				}else{
					$result['response'] = 'Minimo deben ser 3 letras y maximo 45, debe contener letras, numeros o _, -';
					echo json_encode ( $result['response'] );
				}
			}else{
				$result['response'] = 'Campo no puede estar vacio';
				echo json_encode ( $result['response'] );
			}
			
		}
	}else if(isset($_GET["action"]) && $_GET["action"] == "getLineas"){
		require "../modelo/getInitProgramas.php";
		$initProgramas = new Programas();

		if( $_GET['tipoModalidad'] == 'lineaInvestigacion' ){
			echo json_encode ( $initProgramas->getLineas($_GET['id']));
		}else if( $_GET['tipoModalidad'] == 'lineaCuerpoAcademico' ){
			echo json_encode ( $initProgramas->getCuerpoAcademico($_GET['id']));
		}else if( $_GET['tipoModalidad'] == 'procesoConsolidacion' ){
			echo json_encode ( $initProgramas->getProcesoConsolidacion($_GET['id']));
		}
	}else if(isset($_POST["action"]) && $_POST["action"] == "addLinea"){
		require "../modelo/getInitProgramas.php";
		$initProgramas = new Programas();

		if( $_POST['tipoModalidad'] == 'lineaInvestigacion' ){
			echo json_encode ( $initProgramas->addLineas($_POST['programa'], $_POST['nombre']));
		}else if( $_POST['tipoModalidad'] == 'lineaCuerpoAcademico' ){
			echo json_encode ( $initProgramas->addCuerpoAcademico($_POST['programa'], $_POST['nombre']));
		}else if( $_POST['tipoModalidad'] == 'procesoConsolidacion' ){
			echo json_encode ( $initProgramas->addLineaProcesoConsolidacion($_POST['programa'], $_POST['nombre']));
		}
	}else if(isset($_POST["action"]) && $_POST["action"] == "modificarLinea"){
		require "../modelo/getInitProgramas.php";
		$initProgramas = new Programas();

		if( $_POST['tipoModalidad'] == 'lineaInvestigacion' ){
			echo json_encode ( $initProgramas->modificarLineas($_POST['id'], $_POST['nombre']));
		}else if( $_POST['tipoModalidad'] == 'lineaCuerpoAcademico' ){
			echo json_encode ( $initProgramas->modificarCuerpoAcademico($_POST['id'], $_POST['nombre']));
		}else if( $_POST['tipoModalidad'] == 'procesoConsolidacion' ){
			echo json_encode ( $initProgramas->modificarLineaProcesoConsolidacion($_POST['id'], $_POST['nombre']));
		}
	}else if(isset($_POST["action"]) && $_POST["action"] == "eliminarLinea"){
		require "../modelo/getInitProgramas.php";
		$initProgramas = new Programas();

		if( $_POST['tipoModalidad'] == 'lineaInvestigacion' ){
			echo json_encode ( $initProgramas->eliminarLineas($_POST['id']));
		}else if( $_POST['tipoModalidad'] == 'lineaCuerpoAcademico' ){
			echo json_encode ( $initProgramas->eliminarCuerpoAcademico($_POST['id']));
		}else if( $_POST['tipoModalidad'] == 'procesoConsolidacion' ){
			echo json_encode ( $initProgramas->eliminarLineaProcesoConsolidacion($_POST['id']));
		}
	}
?>