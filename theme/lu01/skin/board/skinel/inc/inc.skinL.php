<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

function sl_bootstrap_paging($pagelist)
{
  $pagelist = str_replace('<nav class="pg_wrap"><span class="pg">', '<div class="text-center"><ul class="pagination">', $pagelist);
  $pagelist = str_replace('</span></nav>', '</ul></div>', $pagelist);
  $pagelist = str_replace('<a', '<li><a', $pagelist);
  $pagelist = str_replace('</a>', '</a></li>', $pagelist);
  $pagelist = str_replace(' class="pg_page"', '', $pagelist);
  $pagelist = preg_replace('/(<span[^\>]*>(.*?)<\/span>)/', '', $pagelist);
  $pagelist = preg_replace('/( class="pg_page [^"]+")/', '', $pagelist);
  $pagelist = preg_replace('/(<strong[^\>]*>(.*?)<\/strong>)/', '<li class="active"><a>\2</a></li>', $pagelist);
  return $pagelist;
}

unset($gp_no_list);
unset($gp_no_view);
unset($gp_no_write);

if (!defined('GP')) {

    function gp_do_action($event, $arg = '') {
        
    }

    function gp_do_filter($event, $value) {
        return $value;
    }

    function gp_subval_asort($a, $subkey) {
        if (!is_array($a))
            return $a;
        foreach ($a as $k => $v) {
            $b[$k] = strtolower($v[$subkey]);
        }
        asort($b);
        foreach ($b as $key => $val) {
            $c[] = $a[$key];
        }
        return $c;
    }

    function gp_print($wrapper, $arr, $tag = 'li', $data = '') {
        if (is_array($wrapper))
            list($wtag, $wattr) = $wrapper;
        else {
            $wtag = 'ul';
            $wattr = $wrapper;
        }
        echo '<' . $wtag . ' ' . $wattr . '>' . PHP_EOL;
        for ($i = 0, $to = count($arr); $i < $to; $i++) {
            $item = $arr[$i];
            $is_break = false;
            if ($item['condition']) {
                $item_conditions = explode(",", $item['condition']);
                foreach ($item_conditions as $cond) {
                    if (!$GLOBALS[$cond]) {
                        $is_break = true;
                    }
                }
            }
            if ($is_break)
                continue;

            $li_attr = ($item['attr'] ? ' ' . $item['attr'] : '');
            $a_attr = ($item['href_attr'] ? ' ' . $item['href_attr'] : '');

            if (!$data)
                $data = $item;

            if (strpos($li_attr, 'class="') !== FALSE) {
                if ($i == 0)
                    $li_attr = str_replace('class="', 'class="first ', $li_attr);
                else if ($i == $to - 1)
                    $li_attr = str_replace('class="', 'class="last ', $li_attr);
            } else {
                if ($i == 0)
                    $li_attr = ' class="first"';
                else if ($i == $to - 1)
                    $li_attr = ' class="last"';
            }

            echo '<' . $tag . $li_attr . '>';
            if ($item['href'])
                echo '<a href="' . $item['href'] . '"' . $a_attr . '>' . PHP_EOL;;
            if (!empty($item['render']) && is_callable($item['render']))
                call_user_func_array($item['render'], array($data));
            else
                echo $item['text'];
            if ($item['href'])
                echo PHP_EOL . '</a>' . PHP_EOL;;
            echo '</' . $tag . '>' . PHP_EOL;
        }
        echo '</' . $wtag . '>' . PHP_EOL;
    }

}


if (!function_exists('gp_print_write')) {

    function gp_print_write($arr) {
        for ($i = 0, $to = count($arr); $i < $to; $i++) {
            $item = $arr[$i];
            $is_break = false;
            if ($item['condition']) {
                $item_conditions = explode(",", $item['condition']);
                foreach ($item_conditions as $cond) {
                    if (!$GLOBALS[$cond])
                        $is_break = true;
                }
            }
            if ($is_break) {
                continue;
            }

            $head_class = ($item['head_class'] ? ' class="' . $item['head_class'] . '"' : '');
            $head_for = ($item['head_for'] ? ' for="' . $item['head_for'] . '"' : '');
            $content_class = ($item['content_class'] ? ' class="' . $item['content_class'] . '"' : '');

            $no = ($i + 1);
            if ($i == $to - 2)
                $no = 'last';
            echo '<dl class="slw_row slw_row_' . $no . '">' . PHP_EOL;
            echo '<dt' . $head_class . '>' . PHP_EOL;
            echo '<label' . $head_for . '>';
            if (!empty($item['head_render']) && is_callable($item['head_render']))
                call_user_func_array($item['head_render'], array($item));
            else
                echo $item['head'];
            echo '</label>' . PHP_EOL;
            echo PHP_EOL . '</dt>' . PHP_EOL;
            echo '<dd' . $content_class . '>' . PHP_EOL;

            if (!empty($item['content_render']) && is_callable($item['content_render']))
                call_user_func_array($item['content_render'], array($item));
            else
                echo $item['content'];

            echo PHP_EOL . '</dd>' . PHP_EOL;
            echo PHP_EOL . '</dl>' . PHP_EOL;
        }
    }
}
?>

<link rel="stylesheet" href="<?php echo $board_skin_url; ?>/lib/font-awesome/css/font-awesome.min.css">

