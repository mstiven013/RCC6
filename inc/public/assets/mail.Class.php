<?php

    require_once '../../../../../../wp-load.php';
    
    $formAction = $_POST['action'];
    $email = $_POST['email'];
    $document = $_POST['document'];
    $code = $_POST['code'];
    $info = [];
    
    switch ($formAction) {
        case 'view-draws':
            
            $sendMail = new com6_Mails();
            $sendMail->viewDraws($email,$document);
            
            break;
            
        case 'reg-draws':
            $sendMail = new com6_Mails();
            $sendMail->regDraws($email,$code,$document);
            break;
    }

	class com6_Mails {

		public function regDraws($email,$code,$document) {
		    
		    global $wpdb;
		    $table_draws = $wpdb->prefix . 'com6_draws';
		    $table_users = $wpdb->prefix . 'com6_users';
            
            $sql_select_code = "SELECT number_draw FROM $table_draws WHERE code_number='$code'";
            $query_select_code = $wpdb->get_results($sql_select_code, 'ARRAY_A');
            
            if($query_select_code) {
                
                $sql_select_user = "SELECT firstname FROM $table_users WHERE document='$document'";
		        $query_select_user = $wpdb->get_results($sql_select_user, 'ARRAY_A');
			    
			    if($query_select_user) {
			        
			        require_once 'PHPMailer/PHPMailer/PHPMailer.php';
                    require_once 'PHPMailer/PHPMailer/Exception.php';
                    
                    $mail = new PHPMailer\PHPMailer\PHPMailer(true);                              // Passing `true` enables exceptions
                    //Server settings
                    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    //$mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'mail.webussines.com.co';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = false;                               // Enable SMTP authentication
                
                    //Recipients
                    $mail->setFrom('tclassinternet@webussines.com', 'Ruta Comercial Comuna 6');
                    $mail->addAddress($email);     // Add a recipient
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->AddEmbeddedImage('img/logo.png', 'logopng', 'logopng');
                    $mail->Subject = 'Su codigo se registro exitosamente';
                    
                    $mail->Body = '<html><body>';
        
                    $mail->Body .= '<div style="width: 100%; background-color: #f2f2f2; padding-bottom: 20px; padding-top: 20px;">
                                    <table style="background-color: #fff; border: 1px solid #ccc; border-radius: 5px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; -ms-box-sizing: border-box; box-sizing: border-box; padding: 30px;" width="600" align="center">';
                
                    $mail->Body .= '<tr>
                                    <td style="text-align: center;">
                                        <a href="https://www.rutacomercialcomuna6.com" target="_blank"><img src="cid:logopng" alt="Ruta comercial comuna 6" title="Ruta comercial comuna 6"></a>
                                    </td>
                                </tr>';
                                
                    foreach ($query_select_user as $info_user) {
                        $mail->Body .= '<tr>
                                            <td style="padding-bottom: 20px; padding-top: 20px;">
                                                <p style="font-size: 25px; margin: 0px; text-align: center;">&#161;Hola, <strong>' . $info_user['firstname'] . '</strong>&#33;</p>
                                            </td>
                                        </tr>';
                    }
                
                    $mail->Body .= '<tr>
                                    <td>
                                        <p style="font-size: 18px; margin: 0px; text-align: center;">
                                            Usted tiene registrados los siguientes n&uacute;meros para la rifa
                                        </p>
                                    </td>
                                </tr>';
                
                    $mail->Body .= '<tr>
                                        <td style="padding-bottom: 30px; padding-top: 30px;">
                                            <table width="500" align="center">';
                                            
                    $mail->Body .= '<tr>
                						<th style="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc; font-size: 25px; padding-bottom: 10px; padding-top: 10px; text-align: center; width: 50%;">C&oacute;digo</th>
                						<th style="border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; font-size: 25px; padding-bottom: 10px; padding-top: 10px; text-align: center; width: 50%;">N&uacute;mero</th>
                					</tr>';
                    
                    foreach ($query_select_code as $info_code) {
                        $mail->Body .= '<tr>
                    						<td style="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; font-size: 25px; padding-bottom: 10px; padding-top: 10px; text-align: center;">' . $code . '</td>
                    						<td style="border-bottom: 1px solid #ccc; font-size: 25px; padding-bottom: 10px; padding-top: 10px; text-align: center;">' . $info_code['number_draw'] . '</td>
                    					</tr>';
                    }
                    
                    $mail->Body .= '</table></td></tr>';
                    
                    $mail->Body .= '<tr>
                            			<td style="background-color: #00652e; color: #fff; font-size: 18px; padding-bottom: 20px; padding-top: 20px; text-align: center;">
                            				Ir a <a href="https://www.rutacomercialcomuna6.com" target="_blank" style="color: #fff; font-size: 18px;">Ruta comercial comuna 6</a>
                            			</td>
                            		</tr>';
                
                    $mail->Body .= '</table></div>';
                
                    $mail->Body .= '</body></html>';
                
                    if($mail->send()) {
                        $info['response'] = 'email-sent';
                    } else {
                        $info['response'] = 'email-error-sent';
                    }            
			    } else {
		            $info['response'] = 'el usuario no existe';
		        }
		        
		    } else {
		        $info['response'] = 'el codigo paila';
		    }
            
            echo json_encode($info);
            
            $wpdb->close();
			
		}

		public function viewDraws($email,$document) {
			global $wpdb;
		    $table_draws = $wpdb->prefix . 'com6_draws';
		    $table_users = $wpdb->prefix . 'com6_users';
		    
		    $sql_select_code = "SELECT number_draw,code_number FROM $table_draws WHERE document='$document'";
		    $query_select_code = $wpdb->get_results($sql_select_code, 'ARRAY_A');
		    
		    if($query_select_code) {
		        
		        $sql_select_user = "SELECT firstname FROM $table_users WHERE document='$document'";
		        $query_select_user = $wpdb->get_results($sql_select_user, 'ARRAY_A');
		        
		        if($query_select_user) {
		            
		            require_once 'PHPMailer/PHPMailer/PHPMailer.php';
                    require_once 'PHPMailer/PHPMailer/Exception.php';
                    
                    $mail = new PHPMailer\PHPMailer\PHPMailer(true);                              // Passing `true` enables exceptions
                    //Server settings
                    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    //$mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'mail.webussines.com.co';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = false;                               // Enable SMTP authentication
                
                    //Recipients
                    $mail->setFrom('tclassinternet@webussines.com', 'Ruta Comercial Comuna 6');
                    $mail->addAddress($email);     // Add a recipient
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->AddEmbeddedImage('img/logo.png', 'logopng', 'logopng');
                    $mail->Subject = 'Numeros registrados para la rifa';
                    
                    $mail->Body = '<html><body>';
        
                    $mail->Body .= '<div style="width: 100%; background-color: #f2f2f2; padding-bottom: 20px; padding-top: 20px;">
                                    <table style="background-color: #fff; border: 1px solid #ccc; border-radius: 5px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; -ms-box-sizing: border-box; box-sizing: border-box; padding: 30px;" width="600" align="center">';
                
                    $mail->Body .= '<tr>
                                    <td style="text-align: center;">
                                        <a href="https://www.rutacomercialcomuna6.com" target="_blank"><img src="cid:logopng" alt="Ruta comercial comuna 6" title="Ruta comercial comuna 6"></a>
                                    </td>
                                </tr>';
                    
                    foreach ($query_select_user as $info_user) {
                        $mail->Body .= '<tr>
                                            <td style="padding-bottom: 20px; padding-top: 20px;">
                                                <p style="font-size: 25px; margin: 0px; text-align: center;">&#161;Hola, <strong>' . $info_user['firstname'] . '</strong>&#33;</p>
                                            </td>
                                        </tr>';
                    }
                
                    $mail->Body .= '<tr>
                                    <td>
                                        <p style="font-size: 18px; margin: 0px; text-align: center;">
                                            Usted tiene registrados los siguientes n&uacute;meros para la rifa
                                        </p>
                                    </td>
                                </tr>';
                
                    $mail->Body .= '<tr>
                                        <td style="padding-bottom: 30px; padding-top: 30px;">
                                            <table width="500" align="center">';
                                            
                    $mail->Body .= '<tr>
                						<th style="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc; font-size: 25px; padding-bottom: 10px; padding-top: 10px; text-align: center; width: 50%;">C&oacute;digo</th>
                						<th style="border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; font-size: 25px; padding-bottom: 10px; padding-top: 10px; text-align: center; width: 50%;">N&uacute;mero</th>
                					</tr>';
                
                    foreach ($query_select_code as $info_code) {
                        $mail->Body .= '<tr>
                    						<td style="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; font-size: 25px; padding-bottom: 10px; padding-top: 10px; text-align: center;">' . $info_code['code_number'] . '</td>
                    						<td style="border-bottom: 1px solid #ccc; font-size: 25px; padding-bottom: 10px; padding-top: 10px; text-align: center;">' . $info_code['number_draw'] . '</td>
                    					</tr>';
                    }
                    
                    $mail->Body .= '</table></td></tr>';
                    
                    $mail->Body .= '<tr>
                            			<td style="background-color: #00652e; color: #fff; font-size: 18px; padding-bottom: 20px; padding-top: 20px; text-align: center;">
                            				Ir a <a href="https://www.rutacomercialcomuna6.com" target="_blank" style="color: #fff; font-size: 18px;">Ruta comercial comuna 6</a>
                            			</td>
                            		</tr>';
                
                    $mail->Body .= '</table></div>';
                
                    $mail->Body .= '</body></html>';
                
                    if($mail->send()) {
                        $info['response'] = 'email-sent';
                    } else {
                        $info['response'] = 'email-error-sent';
                    }
		            
		        } else {
		            $info['response'] = 'email-error-sent';
		        }
		        
		    } else {
		        $info['response'] = 'email-error-sent';
		    }
		    
		   echo json_encode($info);
		   
		   $wpdb->close();
		    
		}

	}

 ?>