<?php


  /**
   *
   * Split array base on key
   *
   */
  function keyi ($array, $key, $gather = false) {

    if (! $array)
      return ! is_array ($array) ? false : array ();

    $ret = array ();
    $key = (array) $key;

    reset ($array);

    $_key = array_shift ($key);

    if (isset ($array[0])) {

      if (is_array ($array[0])) {
        while (list (, $v) = each ($array))
          ! isset ($v[$_key]) or (! $gather ? (! isset ($ret[$v[$_key]]) ? $ret[$v[$_key]] = $v : null) : ($gather === true ? $ret[$v[$_key]][] = $v : $ret[$v[$_key]][$gather] = $v));
      }

      else if (is_object ($array[0])) {
        while (list (, $v) = each ($array))
          ! isset ($v->$_key) or (! $gather ? (! isset ($ret[$v->$_key]) ? $ret[$v->$_key] = $v : null) : ($gather === true ? $ret[$v->$_key][] = $v : $ret[$v->$_key][$gather] = $v));
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
   * Dig $key - value from array
   *
   */
  function dig ($array, $key = false, $deep = 1) {

    if (! $array)
      return ! is_array ($array) ? false : array ();

    $ret = Array ();
    $mod = is_object (current ($array)) ? 'o' : 'a';

    if ($deep == 1) {

      reset ($array);

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
   * Object to array
   *
   */
  function otoa ($val) {

    if (is_object ($val))
      $val = get_object_vars ($val);

    if (is_array ($val))
      return array_map (__FUNCTION__, $val);

    return $val;
  }
