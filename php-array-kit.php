<?php


  /**
   *
   * array_walk 的變形
   *
   */
  function walk ($array, $func, $para = NULL) {

    if (! $array)
      return false;

    if (array_walk ($array, $func, $para))
      return $array;

    return false;
  }


  /**
   *
   * 從陣列提取 key(s) 做為 index
   *
   */
  function keyi ($array, $key, $gather = false) {

    if (! $array)
      return false;

    $ret = array ();
    $key = (array) $key;

    reset ($array);

    $_key = array_shift ($key);

    if (isset ($array[0])) {

      if (is_array ($array[0])) {
        while (list (, $v) = each ($array))
          ! isset ($v[$_key]) or (! $gather ? $ret[$v[$_key]] = $v : ($gather === true ? $ret[$v[$_key]][] = $v : $ret[$v[$_key]][$gather] = $v));
      }

      else if (is_object ($array[0])) {
        while (list (, $v) = each ($array))
          ! isset ($v->$_key) or (! $gather ? $ret[$v->$_key] = $v : ($gather === true ? $ret[$v->$_key][] = $v : $ret[$v->$_key][$gather] = $v));
      }
    }

    else
      $ret[$array[$_key]] = $array;

    if (isset ($key[0])) {
      while (list ($k, $r) = each ($ret))
        $ret[$k] = keyi ($r, $key, $gather);
    }

    return $ret;
  }


  /**
   *
   * 掘出陣列裡層的 $key-array
   *
   */
  function dig ($array, $key = false, $deep = 1) {

    if (! $array)
      return false;

    $ret = Array ();
    $mod = is_object (current ($array)) ? 'o' : 'a';

    if ($deep == 1) {

      while (list ($k, $v) = each ($array)) {

        if ($key && $mod == 'a' && isset ($v[$key]))
          $ret[] = $v[$key];

        else if ($key && $mod == 'o' && isset ($v->$key))
          $ret[] = $v->$key;

        else if (! $key)
          $ret = array_merge ($ret, $v);
      }

      return $ret;
    }

    else {
      while (list ($k, $v) = each ($array))
        $ret = array_merge ($ret, dig ($v, $key, $deep - 1));

      return $ret;
    }
  }


  /**
   *
   * 將 array 所有 key 加上 prefix string
   *
   */
  function sticky ($array, $prefix, $ucfirst = false) {

    if (! $array)
      return false;

    $ret = Array ();

    foreach ($array as $_k => $_v) {

      ! $ucfirst or $_k = ucfirst ($_k);

      $ret["$prefix$_k"] = $_v;
    }

    return $ret;
  }


  /**
   *
   * 將 array 所有 key 移除 prefix string
   *
   */
  function tear ($array, $prefix, $lcfirst = false) {

    if (! $array)
      return false;

    $idx = strlen ($prefix);
    $ret = Array ();

    foreach ($array as $_k => $_v) {

      if ($prefix == substr ($_k, 0, $idx)) {
        $k = substr ($_k, $idx);
        $ret[! $lcfirst ? $k : lcfirst ($k)] = $_v;
      }

      else
        $ret[$_k] = $_v;
    }

    return $ret;
  }
