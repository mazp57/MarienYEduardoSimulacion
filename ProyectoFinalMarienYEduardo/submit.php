<?php
	
	//variable obtenida del FORM
	$Fi = $_POST['fi'];
	$Ff = $_POST['ff'];

// PARA CAMBIAR LOS DIAS DE INGLES AL ESPAÑOL
	function CambiarDias($str) { 
		$chars = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" , "Sunday");
		$charsReplace = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
		return str_replace($chars, $charsReplace, $str);
	}
	
	//VALIDACIONES
	
	if(empty($Fi) || empty($Ff)){
		echo '<script>alertify.alert("Error :(", "Por favor ingrese ambas fechas para ejecutar la simulacion");</script>';
	}elseif ($Fi>$Ff){
		echo '<script>alertify.alert("Error :(", "La fecha final debe ser posterior a la inicial");</script>';	
	}else{
		$vfirst = explode ("-", $Ff);
				$vsec = explode ("-", $Fi);
				$diaPrimera    = substr($vfirst[2],0,2);  
				$mesPrimera  = $vfirst[1];  
				$anyoPrimera   = $vfirst[0]; 
			  
				$diaSegunda   = substr($vsec[2],0,2);  
				$mesSegunda = $vsec[1];  
				$anyoSegunda  = $vsec[0];
				$diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
				$diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda); 
				$contvia = 0;
				$dif = ($diasPrimeraJuliano - $diasSegundaJuliano)+1;
				$dia = date('w',strtotime($Fi));
				
		// ADORNAMOS LA SALIDA
		echo'
			<hr>
			<div class="page-header" style="margin:0px 0 20px!important;"><span style="font-size:20px;">&nbsp;Resultados de la <b>simulación</b></span>
			</div>
			<div class="table-responsive">
				<table class="table table-condensed" id="table table-bordered">
					<tr class="info">
					<td><strong>Fecha</strong></td>
					<td><strong>Hora</strong></td>
					<td><strong>Resultado</strong></td>
					<td><strong>Densidad vehícular por Km</strong></td>
					</tr>
		';
		
		//CALCULOS
		for($i=0;$i<$dif;$i++){
			//ADORNO PARA CAMBIAR EL COLOR DE LOS TR DE LAS TABLAS :)
			if($i % 2 == 0){
				$even = "style='background-color: rgb(245, 245, 245);'";
			}else{
				$even = "";
			}
			
			if($dia>=1 && $dia<=5){
				
				for($j=0;$j<3;$j++){
					switch($j){
						case 0:
							$vens = 119 * 12;
							$vesn = 117 * 12;
							$vpmns = 30;
							$vpmsn = 25;
							$viajens = 18;
							$viajesn = 6;
							$interrupns = false;
							$interrupsn = false;
							$vians = false;
							$viasn = false;
							for($k=0;$k<180;$k++){
								$vens += $vpmns;
								$vesn += $vpmsn;
								
								if(mt_rand(1,10000)<=7){
									$interrupns = true;
								}
								if(!$interrupns){
									$vens -= $vpmns;
								}
								if(mt_rand(1,10000)<=4){
									$interrupsn = true;
								}
								if(!$interrupsn){
									$vesn -= $vpmsn;
								}
								$densns = $vens / 12;
								$denssn = $vesn / 12;
								if($densns >= 125){
									if($viasn){
										$vens -= $vpmns;
									}else{
										$vians = true;
										$dvians = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days")))).'</td>
										<td> 6 am - 9 am  </td>
											<td>la vía alterna se activó en este horario en sentido norte-sur</td>
											<td>'.$densns.'</td>
										</tr>
										';
										$contvia++;
									}								
								}
								if($vians){
									$vens -= ($vpmns*2);
									$dvians--;
									if($dvians==0){
										$vians = false;
										$interrupns = false;
									}
								}
								if($denssn >= 125){
									if($vians){
										$vesn -= $vpmsn;
									}else{
										$viasn = true;
										$dviasn = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days")))).'</td>
										<td> 6 am - 9 am  </td>
											<td>la vía alterna se activó en este horario en sentido sur-norte</td>
											<td>'.$denssn.'</td>
										</tr>
										';
										$contvia++;
									}								
								}
								if($viasn){
									$vesn -= ($vpmsn*1.5);
									$dviasn--;
									if($dviasn==0){
										$viasn = false;
										$interrupsn = false;
									}
								}
							}
						break;
						case 1:
							$vens = 105 * 12;
							$vesn = 98 * 12;
							$vpmns = 30;
							$vpmsn = 25;
							$viajens = 18;
							$viajesn = 6;
							$interrupns = false;
							$interrupsn = false;
							$vians = false;
							$viasn = false;
							for($k=0;$k<90;$k++){
								$vens += $vpmns;
								$vesn += $vpmsn;
								
								if(mt_rand(1,10000)<=7){
									$interrupns = true;
								}
								if(!$interrupns){
									$vens -= $vpmns;
								}
								if(mt_rand(1,10000)<=4){
									$interrupsn = true;
								}
								if(!$interrupsn){
									$vesn -= $vpmsn;
								}
								$densns = $vens / 12;
								$denssn = $vesn / 12;
								if($densns >= 125){
									if($viasn){
										$vens -= $vpmns;
									}else{
										$vians = true;
										$dvians = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days"))).'</td>
										<td> 11:30 am - 1 pm  </td>
											<td>la vía alterna se activó en este horario en sentido norte-sur</td>
											<td>'.$densns.'</td>
										</tr>
										';
										$contvia++;
									}								
								}
								if($vians){
									$vens -= ($vpmns*2);
									$dvians--;
									if($dvians==0){
										$vians = false;
										$interrupns = false;
									}
								}
								if($denssn >= 125){
									if($vians){
										$vesn -= $vpmsn;
									}else{
										$viasn = true;
										$dviasn = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days"))).'</td>
										<td> 11:30 am - 1 pm  </td>
											<td>la vía alterna se activó en este horario en sentido sur-norte</td>
											<td>'.$denssn.'</td>
										</tr>
										';
										$contvia++;
									}								
								}
								if($viasn){
									$vesn -= ($vpmsn*1.5);
									$dviasn--;
									if($dviasn==0){
										$viasn = false;
										$interrupsn = false;
									}
								}
							}
						break;
						case 2:
							$vens = 120 * 12;
							$vesn = 76 * 12;
							$vpmns = 30;
							$vpmsn = 25;
							$viajens = 18;
							$viajesn = 6;
							$interrupns = false;
							$interrupsn = false;
							$vians = false;
							$viasn = false;
							for($k=0;$k<255;$k++){
								$vens += $vpmns;
								$vesn += $vpmsn;
								
								if(mt_rand(1,10000)<=7){
									$interrupns = true;
								}
								if(!$interrupns){
									$vens -= $vpmns;
								}
								if(mt_rand(1,10000)<=4){
									$interrupsn = true;
								}
								if(!$interrupsn){
									$vesn -= $vpmsn;
								}
								$densns = $vens / 12;
								$denssn = $vesn / 12;
								if($densns >= 125){
									if($viasn){
										$vens -= $vpmns;
									}else{
										$vians = true;
										$dvians = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days"))).'</td>
										<td> 5 pm - 7:30 pm  </td>
											<td>la vía alterna se activó en este horario en sentido norte-sur</td>
											<td>'.$densns.'</td>
										</tr>
										';
										$contvia++;
									}								
								}
								if($vians){
									$vens -= ($vpmns*2);
									$dvians--;
									if($dvians==0){
										$vians = false;
										$interrupns = false;
									}
								}
								if($denssn >= 125){
									if($vians){
										$vesn -= $vpmsn;
									}else{
										$viasn = true;
										$dviasn = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days"))).'</td>
										<td> 5 pm - 9:15 pm  </td>
											<td>la vía alterna se activó en este horario en sentido sur-norte</td>
											<td>'.$denssn.'</td>
										</tr>
										';
										$contvia++;
									}								
								}
								if($viasn){
									$vesn -= ($vpmsn*1.5);
									$dviasn--;
									if($dviasn==0){
										$viasn = false;
										$interrupsn = false;
									}
								}
							}
							
						break;
					}


				}
			}else{
				
				for($j=0;$j<3;$j++){

					switch($j){
						case 0:
							$vens = 107 * 12;
							$vesn = 105 * 12;
							$vpmns = 30;
							$vpmsn = 25;
							$viajens = 18;
							$viajesn = 6;
							$interrupns = false;
							$interrupsn = false;
							$vians = false;
							$viasn = false;
							for($k=0;$k<120;$k++){
								$vens += $vpmns;
								if(mt_rand(1,10000)<=7){
									$interrupns = true;
								}
								if(!$interrupns){
									$vens -= $vpmns;
								}
								
								$densns = $vens / 12;
								
								if($densns >= 125){
									
										$vians = true;
										$dvians = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days"))).'</td>
										<td> 1 pm - 3 pm  </td>
											<td>la vía alterna se activó en este horario en sentido norte-sur</td>
											<td>'.$densns.'</td>
										</tr>
										';
										$contvia++;							
								}
								if($vians){
									$vens -= ($vpmns*2);
									$dvians--;
									if($dvians==0){
										$vians = false;
										$interrupns = false;
									}
								}
								
							}
							for($k=0;$k<150;$k++){
								
								$vesn += $vpmsn;
								if(mt_rand(1,10000)<=4){
									$interrupsn = true;
								}
								if(!$interrupsn){
									$vesn -= $vpmsn;
								}
								$denssn = $vesn / 12;
								
								if($denssn >= 125){
										$viasn = true;
										$dviasn = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days"))).'</td>
										<td> 7 am - 9:30 am  </td>
											<td>la vía alterna se activó en este horario en sentido sur-norte</td>
											<td>'.$denssn.'</td>
										</tr>
										';
										$contvia++;							
								}
								if($viasn){
									$vesn -= ($vpmsn*1.5);
									$dviasn--;
									if($dviasn==0){
										$viasn = false;
										$interrupsn = false;
									}
								}
							}
						break;
						case 1:
							$vens = 80 * 12;
							$vesn = 54 * 12;
							$vpmns = 30;
							$vpmsn = 25;
							$viajens = 18;
							$viajesn = 6;
							$interrupns = false;
							$interrupsn = false;
							$vians = false;
							$viasn = false;
							for($k=0;$k<150;$k++){
								$vens += $vpmns;
								$vesn += $vpmsn;
								
								if(mt_rand(1,10000)<=7){
									$interrupns = true;
								}
								if(!$interrupns){
									$vens -= $vpmns;
								}
								if(mt_rand(1,10000)<=4){
									$interrupsn = true;
								}
								if(!$interrupsn){
									$vesn -= $vpmsn;
								}
								$densns = $vens / 12;
								$denssn = $vesn / 12;
								if($densns >= 125){
									if($viasn){
										$vens -= $vpmns;
									}else{
										$vians = true;
										$dvians = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days"))).'</td>
										<td> 6 pm - 8 pm  </td>
											<td>la vía alterna se activó en este horario en sentido norte-sur</td>
											<td>'.$densns.'</td>
										</tr>
										';
										$contvia++;
									}								
								}
								if($vians){
									$vens -= ($vpmns*2);
									$dvians--;
									if($dvians==0){
										$vians = false;
										$interrupns = false;
									}
								}
								if($denssn >= 125){
									if($vians){
										$vesn -= $vpmsn;
									}else{
										$viasn = true;
										$dviasn = 120;
										echo '
										<tr '.$even.'>
										<td>'.CambiarDias(date("l d-m-Y",strtotime($Fi."+ ".$i. "days"))).'</td>
										<td> 4:30 pm - 10 pm  </td>
											<td>la vía alterna se activó en este horario en sentido sur-norte</td>
											<td>'.$denssn.'</td>
										</tr>
										';
										$contvia++;
									}								
								}
								if($viasn){
									$vesn -= ($vpmsn*1.5);
									$dviasn--;
									if($dviasn==0){
										$viasn = false;
										$interrupsn = false;
									}
								}
							}
							
						break;
						
					}
				}	
			}
			if($dia<=6){
				$dia++;
			}elseif($dia>6){
				$dia=0;
			}
			
		
		//ecuación para sacar la probabilidad
	}
			if($contvia==0){
			echo '		<tr '.$even.'>
						<td></td>
						<td>   </td>
						<td>La vía alterna no se activó ningún día<td>
						</tr>
						';}
		// MOSTRAMOS EL RESTO DE LA SALIDA
		echo '
				</table>
			</div>
			<div style="background-color: #d9edf7;padding: 23px;border-radius: 4px;">
				<div class="row">
					<div class="col-md-12 texto">
						<div style="margin:14px;">
							<span style="font-size:18px;"><strong>Simulaciones:</strong> '.$dif.'</span><br>
							<span style="font-size:18px;"><strong>Veces que se habilitó la vía alterna:</strong> '.$contvia.'</span>
						</div>
					</div>
				</div>
			</div>
		';
	}
?>