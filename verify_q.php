<?php

if(!(isset($_GET['tid']))) {
    http_response_code(404);
    exit();
}

$ref = 'https://mail.google.com/';

require_once 'send_email.php';
require_once 'emails.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/class-db.php';

$db = new Db();
    
// Prepare an insert statement
$sql = "UPDATE queries SET status = ? WHERE thread_id = ? AND status = 'Waiting for sender varification'";
if($stmt = $db->db->prepare($sql)){

    //Values
    $new_status = 'Recieved';
    $thread_id = $_GET['tid'];

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("si", $new_status, $thread_id);
    $stmt->execute();

    $result = $db->db->affected_rows;

    if(!($result <= 0)) {
        $sql = "SELECT thread_id, full_name, email, subject FROM queries WHERE thread_id = ? AND status = 'Recieved'";
        if($stmt2 = $db->db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt2->bind_param("i", $thread_id);
            $stmt2->execute();
            $result = $stmt2->get_result();
            $data = $result->fetch_assoc();
            
            $thread_id = $data['thread_id'];
            $full_name = ucwords($data['full_name']);
            $subject = $data['subject'];
            $email = $data['email'];

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
                            <div style="display: inline-block; width: 100%; max-width: 700px;background-color: white;margin: 0;padding: 10px 15px;">
                                <table role="presentation" style="width:100%;border-collapse:collapse;border-spacing:0;">
                                    <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                                        <td style="margin: 0;padding:15px 0">
                                            <p style="text-align: left; font-size: 20px">Hi Ma'am/Sir $full_name,</p>
                                            <p style="text-align: left; ">Thank you for contacting us and also for visiting our website 
                                            <a href="https://mpministry.site">https://mpministry.site</a>.</p>
                                            <p style="text-align: left; ">Please note that this is a system-generated message.</p>
                                            <p style="text-align: left; ">Regarding your query, expect our reply in this message as soon as we read your query.</p>
                                            <p style="text-align: left; ">If you wish, We can also extend our conversation if we have something more to talk about by 
                                            using other platforms such as Messenger, Skype, etcetera.</p>
                                        </td>
                                    </tr>
                                    <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                                        <td style="margin: 0;padding: 0">
                                            <p style="font-weight: bold; font-size: 20px; margin: 0 0 10px 0; padding: 0; color: gray;text-align: left">Thank You!</p>
                                            <p style="margin: 0 0 8px 0;padding: 0;text-align: left;">Sincerely,</p>
                                            <p style="margin: 0 0 8px 0;padding: 0;text-align: left;">The Macedonian Personal Ministry Team.</p>
                                        </td>
                                    </tr>
                                    <tr style="width: 100%;padding: 0;margin: 0;text-align: center;" >
                                        <td style="margin: 0;padding: 0">
                                            <p style="margin: 15px 0 25px 0;padding: 0;text-align: left;"><strong>Type of message:</strong> System generated via MPM website.</p>
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
            $param = [
                "subject" => "[[Query]] MPM | $subject | $thread_id",
                "body" => $body,
            ];

            if(send_email_to_user($email, $param)) {
                header("Location: $ref");
                exit();
            } else {
                echo "error occured!";
            }
        } else {
            echo "error";
        }
    } else {
        echo 'erro occured';
    }
}

