<?php

header('Access-Control-Allow-Origin: *');//Allow COR

require_once 'send_email.php';
// require_once 'config.php';

if(!($_SERVER['REQUEST_METHOD'] == "POST")) {
    http_response_code(404);
    exit();
}

$json_str = file_get_contents('php://input');

$data = (array) json_decode($json_str);

$full_name = htmlentities($data['full_name'], ENT_QUOTES, 'UTF-8');
$email = htmlentities($data['email'], ENT_QUOTES, 'UTF-8');
$request_id = htmlentities($data['request_id'], ENT_QUOTES, 'UTF-8');
$exp_date = htmlentities($data['exp_date'], ENT_QUOTES, 'UTF-8');

$body = <<<TOF
<div style="display: inline-block; width: 100%; text-align: center; padding: 0; margin: 0;background-color: #d2dceb96">
    <table role="presentation" style="width:100%;border-collapse:collapse; border-spacing:0;">
        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;">
            <td style="margin: 0; padding:30px 0">
               <img style="padding:0;margin: 0; width: 250px" src="https://drive.google.com/uc?id=14298ATU0ZzPHXCFU6OrZjzdNmVKNhzXY"></img>
               <p style="color: #77b7e9; font-size: 18px;padding:0;margin:10px 0 5px 0">THE MISSION IS STILL THE SAME</p>
               <p style="color: #9e9f9f; font-size: 11px;padding:0;margin:0">Matthew 28:19-20</p>
            </td>
        </tr>
        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
            <td style="margin: 0;padding: 0 10px;">
                <div style="display: inline-block; width: 100%; max-width: 700px;background-color: white;margin: 0;padding:0">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border-spacing:0;">
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding:15px 0">
                                <p> You sent us a Membership request from our website <a href="https://mpministry.site">https://mpministry.site</a> </p>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding:15px 0">
                                <form style="display: inline-block; min-width: 350px; width: 30%; padding: 20px 0; background-color: #dad4d41c; box-shadow: 0 0 5px 1px #d0c1c1; margin: 15px 0 0 0">
                                    <input style="min-width: 300px; width: 80%; height: 40px; margin-bottom: 15px; border: none;outline: 1.5px solid rgba(0, 94, 170, 0.479);" value="$full_name" disabled></input>
                                    <input style="min-width: 300px; width: 80%; height: 40px; margin-bottom: 15px; border: none;outline: 1.5px solid rgba(0, 94, 170, 0.479);" value="$email" disabled></input>
                                </form>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding:15px 0">
                                <p style="margin: 0 0 5px 0;">If this was made by you? please click <a href="http://localhost:82/verify_request.php?request_id=$request_id">YES</a> or else <a href="http://localhost:82/cancel_request.php?request_id=$request_id" style="color: red">NO</a>.</p>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding:15px 0">
                                <strong style="margin: 0 0 5px 0;color: green">Expires on $exp_date</strong>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding: 0">
                                <p style="font-weight: bold; font-size: 20px; margin: 0 0 5px 0; padding: 0; color: gray;">Thank You!</p>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding: 0">
                                <p style="margin: 0 0 8px 0;padding: 0;">-Macedonian Personal Ministry</p>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding: 0">
                                <p style="margin: 0 0 25px 0;padding: 0;"><strong>Type of Message:</strong> System Generated via MPM website.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
            <td style="margin: 0;padding: 0 10px;">
                <div style="display: inline-block; width: 100%; max-width: 700px;margin: 10px 0 0 0;padding:0">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border-spacing:0;">
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding:15px 0; width: 45%;">
                                <img style="width: 95%;padding: 0; margin: 0 10px 0 0" src="https://drive.google.com/uc?id=1ZWVtjQfR1n2mh1nFubuXYuLXlQOzkXic">
                            </td>
                            <td style="margin: 0;padding:15px 0;text-align: justify">
                                <p style="padding: 0;margin: 0 0 8px 0; font-weight: bold">OUR BEGINNING</p>
                                <p style="margin: 0;padding: 0;">The Macedonian Personal Ministry, Inc (MPM) was originally conceptualized by Pastor 
                                    Ferdinand S. Florez of the Church of Christ at Roxas, Isabela in 2018. Although, it
                                    took a whole year of planning, promotion, and collaboration. It was formally 
                                    launched in June 2019. Some of the Churches of Christ pastors who also spearheaded 
                                    the MPM launching were Pastor Art Santiago of Las Pinas, Pastor Ephraim Sison of 
                                    Balic-Balic, Pastor Vher Palang of Project 7, and many others. MPM was registered 
                                    with the Security Exchange Commission on November 26, 2019. Today, there are hundreds 
                                    of leaders and church members of the Churches of Christ in the Philippines and abroad 
                                    who have already joined and committed to this personal ministry.
                                </p>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding:15px 0; width: 45%;">
                                <img style="width: 95%;padding: 0; margin: 0 10px 0 0" src="https://drive.google.com/uc?id=1GgmjCd472_lqzKthQ6NPox4tvlR3xfkl">
                            </td>
                            <td style="margin: 0;padding:15px 0;text-align: justify">
                                <p style="padding: 0;margin: 0 0 8px 0; font-weight: bold">OUR MISSION</p>
                                <p style="margin: 0;padding: 0;">Macedonian Personal Ministry (MPM) is a faith-based and 
                                non-profit organization within the Churches of Christ and Christian Churches whose main goal 
                                is to fulfill the Great Commission stated in Matthew 28:19-20. MPM also wants to fulfill Jesus 
                                Christ’s commands for believers to serve one another in love.
                                </p>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding:15px 0; width: 45%;">
                                <img style="width: 95%;padding: 0; margin: 0 10px 0 0" src="https://drive.google.com/uc?id=1ABuVbc-jKfGkvhgzLjaMc7sGv7sBiNwN">
                            </td>
                            <td style="margin: 0;padding:15px 0;text-align: justify">
                                <p style="padding: 0;margin: 0 0 8px 0; font-weight: bold">OUR METHOD</p>
                                <p style="margin: 0;padding: 0;">In conjunction with local churches,  MPM leaders travel around the 
                                country to visit churches that seek assistance through the training provided by MPM’s faithful, 
                                dedicated and hardworking pastors and leaders. Seminars and workshops are held to introduce and 
                                share MPM’s vision to obey Jesus Christ’s command to spread the Gospel as well as teaching believers 
                                to desire continued spiritual growth and maturity hence be propagators of the Gospel, too.
                                </p>
                            </td>
                        </tr>
                        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                            <td style="margin: 0;padding:15px 0; width: 45%;">
                                <img style="width: 95%;padding: 0; margin: 0 10px 0 0" src="https://drive.google.com/uc?id=1bzgV96rMlTcw4hVrbr7zceqI7gN6Pewb">
                            </td>
                            <td style="margin: 0;padding:15px 0;text-align: justify">
                                <p style="padding: 0;margin: 0 0 8px 0; font-weight: bold">OUR COMMITMENT</p>
                                <p style="margin: 0;padding: 0;">To our Lord and Savior Jesus Christ</p>
                                <p style="margin: 0;padding: 0;color: gray;margin: 5px 0;padding: 0">-by obeying His commandment faithfully!</p>
                                <p style="margin: 0;padding: 0;">To the local churches</p>
                                <p style="margin: 0;padding: 0;color: gray;margin: 5px 0;padding: 0">-by giving financial assistance in building new churches edifice, 
                                renovations, beautification projects, etc.
                                </p>
                                <p style="margin: 0;padding: 0;">To our members</p>
                                <p style="margin: 0;padding: 0;color: gray;margin: 5px 0;padding: 0">-by giving financial aid during hardships caused by serious illness, 
                                death in the family, legal assistance, calamities triggered by natural disasters, the most recent of 
                                which was the covid-19 pandemic.
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
            <td style="margin: 0;padding: 15px; background-color: black">
                <p style="margin: 0 0 5px 0;padding: 0; color: white">© Macedonian Personal Ministry, Inc.</p>
            </td>
        </tr>
    </table>
</div>
TOF;

$verify_membership_param = [
    "subject" => "[[Verify Membership request]] Macedonian Personal Ministry",
    "body" => $body,
];

header('Content-Type: application/json; charset=UTF-8');

if(send_email_to_user($email, $verify_membership_param)) {
    $db = new Db();
    
    // Prepare an insert statement
    $sql = "INSERT INTO membership_request (request_id, full_name, email, exp_date) VALUES (?, ?, ?, ?)";
    if($stmt = $db->db->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("isss", $request_id, $full_name, $email, $exp_date);
        $stmt->execute();
        // Close statement
        $stmt->close();
        
        // Close connection
        $db->db->close();
    }

    
    echo json_encode(['ok' => true]);
} else {
    echo json_encode(['ok' => false]);
}
