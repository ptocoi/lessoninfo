<?php
if (!defined('_GNUBOARD_')) exit;

// 외부로그인
function banner($skin_dir='basic')
{
    

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $banner_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/banner/'.$match[1];
            if(!is_dir($banner_skin_path))
                $banner_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/banner/'.$match[1];
            $banner_skin_url = str_replace(G5_PATH, G5_URL, $banner_skin_path);
        } else {
            $banner_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/banner/'.$match[1];
            $banner_skin_url = str_replace(G5_PATH, G5_URL, $banner_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if (G5_IS_MOBILE) {
            $banner_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/banner/'.$skin_dir;
            $banner_skin_url = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/banner/'.$skin_dir;
        } else {
            $banner_skin_path = G5_SKIN_PATH.'/banner/'.$skin_dir;
            $banner_skin_url = G5_SKIN_URL.'/banner/'.$skin_dir;
        }
    }

    // 읽지 않은 쪽지가 있다면
    if ($is_member) {
        $sql = " select count(*) as cnt from {$g5['memo_table']} where me_recv_mb_id = '{$member['mb_id']}' and me_read_datetime = '0000-00-00 00:00:00' ";
        $row = sql_fetch($sql);
        $memo_not_read = $row['cnt'];

        $is_auth = false;
        $sql = " select count(*) as cnt from {$g5['auth_table']} where mb_id = '{$member['mb_id']}' ";
        $row = sql_fetch($sql);
        if ($row['cnt'])
            $is_auth = true;
    }

    $banner_url        = login_url($urlencode);
    $banner_action_url = G5_HTTPS_BBS_URL.'/login_check.php';

    ob_start();
    include_once ($banner_skin_path.'/banner.skin.2.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>