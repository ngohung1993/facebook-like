<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 1/18/2018
 * Time: 3:09 PM
 */

namespace console\controllers;

use yii\db\Expression;
use yii\console\Controller;
use common\models\BuffSub;
use common\models\BuffLike;
use common\models\BuffShare;
use common\models\BuffComment;
use common\helpers\ConnectHelper;
use common\helpers\FacebookHelper;

class BuffController extends Controller
{
    public $message;

    public function options($actionID)
    {
        return ['message'];
    }

    public function optionAliases()
    {
        return ['m' => 'message'];
    }

    public function actionIndex()
    {
        $access_tokens = ConnectHelper::get_access_token(1500);

        switch ($this->message) {
            case 1:
                $buff_likes = BuffLike::find()->where(['status' => 1])->andWhere('liked < like_total')->orderBy(new Expression('rand()'))->limit(30)->all();

                foreach ($buff_likes as $key => $value) {

                    $key_token = 'EAAAAAYsX7TsBACKy0BNmqhfhCEgZCqUQQREpLYnSmnTSN5ClSoBLEtWYiXiuwBeZCAzgIxwAlmNqMesTCw6HIy0slzxjwUf5QUZB3ouNvelOi1UQihDuUh1tX8pgWBEL9GAiS8bZBYuGpvddSrYEkAlZCTocWUgxn5pWPT3zpUjBVZBRtAgyFq1KUF3ZAQZBZAiSP8cEk0zMsXeA69kMqvio2';

                    $check_post = FacebookHelper::check_post_exits($value['post_id'], $key_token);

                    if ($check_post) {
                        $find_post = BuffLike::findOne($value['id']);
                        $find_post->status = 0;
                        $find_post->save();

                        echo 'Post do not exit ' . $value['post_id'] . "\n";
                    } else {
                        $emotions = json_decode($value['emotion']);

                        $access_tokens_available = [];
                        $path = './uploads/runtime/log-likes/' . $value['user']['username'] . '.txt';
                        $logs = '';

                        if (file_exists($path)) {
                            $logs = file_get_contents($path);
                        }

                        foreach ($access_tokens as $access_token) {
                            if (strpos($logs, $access_token['uid'] . '|' . $value['post_id']) === false) {
                                $access_tokens_available[] = $access_token;
                            }

                            if (count($access_tokens_available) == $value['speed']) {
                                break;
                            }
                        }

                        $count = 0;
                        for ($i = 0; $i < count($access_tokens_available); $i++) {

                            if (count($emotions)) {

                                $key_emotion = array_rand($emotions);

                                $result = FacebookHelper::buff_like($value['post_id'], $access_tokens_available[$i]['access_token'], $emotions[$key_emotion]);

                                if ($result) {
                                    $count++;
                                }

                                $file_name = './uploads/runtime/log-access-token/' . $access_tokens_available[$i]['uid'] . '.txt';
                                if (!file_exists($file_name)) {
                                    $fp = fopen($file_name, 'w');
                                    fclose($fp);
                                    chmod($file_name, 0755);
                                }

                                $fp = fopen($file_name, "a");
                                fwrite($fp, $value['post_id'] . '|' . $emotions[$key_emotion] . '|' . $result . "\n");
                                fclose($fp);

                                $file_name = './uploads/runtime/log-likes/' . $value['user']['username'] . '.txt';
                                if (!file_exists($file_name)) {
                                    $fp = fopen($file_name, 'w');
                                    fclose($fp);
                                    chmod($file_name, 0755);
                                }

                                $fp = fopen($file_name, "a");
                                fwrite($fp, $access_tokens_available[$i]['uid'] . '|' . $value['post_id'] . '|' . $result . "\n");
                                fclose($fp);
                            }
                        }

                        $value['liked'] += $count;
                        $value->save();

                        echo 'Like successfully ' . $count . ' times of post ' . $value['post_id'] . "\n";
                    }
                }
                break;
            case 2:
                $buff_comments = BuffComment::find()->where(['status' => 1])->where('commented < comment_total')->limit(60)->all();

                foreach ($buff_comments as $key => $value) {

                    $access_tokens_available = [];

                    $path = './uploads/runtime/log-comments/' . $value['user']['username'] . '.txt';
                    $logs = '';
                    if (file_exists($path)) {
                        $logs = file_get_contents($path);
                    }

                    foreach ($access_tokens as $access_token) {
                        if (strpos($logs, $access_token['uid'] . '|' . $value['post_id']) === false) {
                            $access_tokens_available[] = $access_token;
                        }

                        if (count($access_tokens_available) == $value['speed']) {
                            break;
                        }
                    }

                    $content = json_decode($value['content']);

                    $key_token = array_rand($access_tokens_available);

                    $check_post = FacebookHelper::check_post_exits($value['post_id'], $access_tokens_available[$key_token]['access_token']);

                    if ($check_post) {
                        $find_post = BuffComment::findOne($value['id']);
                        $find_post->status = 0;
                        $find_post->save();
                    }

                    $count = 0;
                    if ((is_array($content)) && (count($content) > 0)) {

                        for ($i = 0; $i < count($access_tokens_available); $i++) {

                            $key_message = array_rand($content);

                            $result = FacebookHelper::buff_comment($value['post_id'], $access_tokens_available[$i]['access_token'], $content[$key_message]);

                            if ($result) {
                                $count++;

                            }

                            $save_log = fopen('./uploads/runtime/log-comments/' . $value['user']['username'] . '.txt', "a");
                            chmod('./uploads/runtime/log-comments/' . $value['user']['username'] . '.txt', 0777);
                            fwrite($save_log, $access_tokens_available[$i]['uid'] . '|' . $value['post_id'] . '|' . $result . "\n");
                            fclose($save_log);
                        }

                        $value['commented'] += $count;
                        $value->save();
                    }

                    echo 'Comment successfully ' . $count . ' times of post ' . $value['post_id'] . '<br>';
                }
                break;
            case 3:
                $buff_shares = BuffShare::find()->where('shared < share_total')->limit(60)->all();

                foreach ($buff_shares as $key => $value) {

                    $access_tokens_available = [];
                    $logs = '';
                    $path = './uploads/runtime/log-shares/' . $value['user']['username'] . '.txt';

                    if (file_exists($path)) {
                        $logs = file_get_contents($path);
                    }

                    foreach ($access_tokens as $access_token) {
                        if (strpos($logs, $access_token['uid'] . '|' . $value['post_id']) === false) {
                            $access_tokens_available[] = $access_token;
                        }
                        if (count($access_tokens_available) == $value['speed']) {
                            break;
                        }
                    }

                    $count = 0;
                    for ($i = 0; $i < count($access_tokens_available); $i++) {

                        $result = FacebookHelper::buff_share($value['post_id'], $access_tokens_available[$i]['access_token']);
                        if ($result) {
                            $count++;


                        }
                        $save_log = fopen('./uploads/runtime/log-shares/' . $value['user']['username'] . '.txt', 'a');
                        chmod('./uploads/runtime/log-shares/' . $value['user']['username'] . '.txt', 0777);
                        fwrite($save_log, $access_tokens_available[$i]['uid'] . '|' . $value['post_id'] . '|' . $result . "\n");
                        fclose($save_log);
                    }


                    $value['shared'] += $count;
                    $value->save();

                    echo 'Share successfully ' . $count . ' times of post ' . $value['post_id'];
                }
                break;
            case 4:
                $buff_subs = BuffSub::find()->where('subscribed < subscribe_total')->limit(60)->all();

                foreach ($buff_subs as $key => $value) {

                    $access_tokens_available = [];
                    $logs = '';
                    $path = './uploads/runtime/log-subs/' . $value['user']['username'] . '.txt';

                    if (file_exists($path)) {
                        $logs = file_get_contents($path);
                    }

                    foreach ($access_tokens as $access_token) {
                        if (strpos($logs, $access_token['uid']) === false) {
                            $access_tokens_available[] = $access_token;
                        }
                        if (count($access_tokens_available) == $value['speed']) {
                            break;
                        }
                    }

                    $count = 0;
                    for ($i = 0; $i < count($access_tokens_available); $i++) {


                        $result = FacebookHelper::buff_sub($value['uid'], $access_tokens_available[$i]['access_token']);

                        if ($result) {
                            $count++;


                        }
                        $save_log = fopen('./uploads/runtime/log-subs/' . $value['user']['username'] . '.txt', 'a');
                        chmod('./uploads/runtime/log-subs/' . $value['user']['username'] . '.txt', 0777);
                        fwrite($save_log, $access_tokens_available[$i]['uid'] . '|' . $result . "\n");
                        fclose($save_log);
                    }

                    $value['subscribed'] += $count;
                    $value->save();

                    echo 'Subscribe successfully ' . $count . ' times of post ' . $value['uid'];
                }
                break;
            default;
                break;
        }
    }

}