<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/class-db.php';
require_once 'send_email.php';
require_once 'emails.php';

if(!isset($_GET['thread_id'])) {
    http_response_code(404);
    exit();
}

$thread_id = $_GET['thread_id'];

$db = new Db();

$sql = $db->db->query("SELECT * FROM queries WHERE thread_id = '$thread_id'");
$result = $sql->fetch_assoc();

if(!$result) {
    http_response_code(404);
    exit();
}

$full_name = $result['full_name'];
$email = $result['email'];
$subject = $result['subject'];
$query = $result['query'];
$thread_id = $result['thread_id'];

if(time() > strtotime($result['exp_date'])) {
    $delete_expired_query_sql = $db->db->query("DELETE FROM queries WHERE thread_id = '$thread_id'");
    echo '<h1 style="color: red;text-align:center;margin-top: 100px">This Query Has Expired</h1>';
    exit();
} 

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
                                <p style="text-align: left; font-size: 20px">New Query From $full_name</p>
                                <div style="display: block;text-align: left"><strong style="display: inline-block;width: 100px;margin-bottom: 5px">Subject: </strong> $subject</div>
                                <div style="display: block;text-align: left"><strong style="display: inline-block;width: 100px;margin-bottom: 5px">Query: </strong> $query</div>
                                <div style="display: block;text-align: left"><strong style="display: inline-block;width: 100px;margin-bottom: 5px">Email: </strong> $email</div>
                                <div style="display: block;text-align: left"><strong style="display: inline-block;width: 100px">Thread Id: </strong> $thread_id</div>
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

$query = $result['query'];
$new_query_param = [
    "subject" => "[[New Query:<<$full_name>>]] Macedonian Personal Ministry",
    "body" => $body
];

if(send_email_to_user(CUSTOMER_SERVICE, $new_query_param)) {
    $delete_verified_query_sql = $db->db->query("DELETE FROM queries WHERE thread_id = '$thread_id'");
    echo '<h1 style="color: #00ff0d;text-align:center;margin-top: 100px">Varfied Successfully!</h1>';
    exit();
}

echo '<h1 style="color: red;text-align:center;margin-top: 100px">Error Occured!</h1>';


// $expdate = strtotime($result['exp_date']);
// echo date('d/M/Y h:i:s', $expdate);


