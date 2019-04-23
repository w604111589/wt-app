<?php
namespace App\Http\Models;

class ServerInfo
{

    public function get_ip()
    {   
        $ip = '';
        if(isset($_SERVER['SERVER_ADDR'])){
            $ip =  $_SERVER['SERVER_ADDR'];
        }
        return $ip;
    }

    public function get_uptime($arg)
    {

        $str   = @file_get_contents('/proc/uptime');
        $num   = floatval($str);

        $secs  = fmod($num, 60);
        $num = intdiv($num, 60);
        $mins  = $num % 60;
        $num = intdiv($num, 60);
        $hours = $num % 24;
        $num = intdiv($num, 24);
        $days  = $num;

        if ($arg == 'secs') {
            return $days . "&nbsp" . "Days" . "&nbsp" . $hours . "&nbsp" . "Hours" . "&nbsp" . $mins . "&nbsp" . "Mins" . "&nbsp" . $this->round_up($secs, 0) . "&nbsp" . "Secs" . "&nbsp";
        } else if ($arg == 'mins') {
            return $days . "&nbsp" . "Days" . "&nbsp" . $hours . "&nbsp" . "Hours" . "&nbsp" . $mins . "&nbsp" . "Mins" . "&nbsp";
        } else if ($arg == 'hours') {
            return $days . "&nbsp" . "Days" . "&nbsp" . $hours . "&nbsp" . "Hours" . "&nbsp";
        } else if ($arg == 'days') {
            return $days . "&nbsp" . "Days" . "&nbsp";
        }
    }

    function get_total_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $memtotal = $file_line[0];
        $memtotal = filter_var($memtotal, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return (int)$memtotal;
        } else if ($args == 'mb') {
            $memtotal_mb = $this->convert($memtotal, 'mb');
            return $memtotal_mb;
        } else if ($args == 'gb') {
            $memtotal_gb = $this->convert($memtotal, 'gb');
            return $memtotal_gb;
        }
    }

    //--------------------------------------------
    //-      Function to get Mem Available       -
    //--------------------------------------------
    public function get_available_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $memavailable = $file_line[2];
        $memavailable = filter_var($memavailable, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return (int)$memavailable;
        } else if ($args == 'mb') {
            $memavailable_mb = $this->convert($memavailable, 'mb');
            return $memavailable_mb;
        } else if ($args == 'gb') {
            $memavailable_gb = $this->convert($memavailable, 'gb');
            return $memavailable_gb;
        }
    }


    //--------------------------------------------
    //-        Function to get Cached Mem        -
    //--------------------------------------------
    public function get_cached_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $memcached = $file_line[4];
        $memcached = filter_var($memcached, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return (int)$memcached;
        } else if ($args == 'mb') {
            $memcached_mb = $this->convert($memcached, 'mb');
            return $memcached_mb;
        } else if ($args == 'gb') {
            $memcached_gb = $this->convert($memcached, 'gb');
            return $memcached_gb;
        }
    }

    //--------------------------------------------
    //-         Function to get Swap Mem        -
    //--------------------------------------------
    public function get_swap_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $memswap = $file_line[14];
        $memswap = filter_var($memswap, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return (int)$memswap;
        } else if ($args == 'mb') {
            $memswap_mb = $this->convert($memswap, 'mb');
            return $memswap_mb;
        } else if ($args == 'gb') {
            $memswap_gb = $this->convert($memswap, 'gb');
            return $memswap_gb;
        }
    }

    //--------------------------------------------
    //-        Function to get Buffer Mem        -
    //--------------------------------------------
    public function get_buffer_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $membuffer = $file_line[3];
        $membuffer = filter_var($membuffer, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return (int)$membuffer;
        } else if ($args == 'mb') {
            $membuffer_mb = $this->convert($membuffer, 'mb');
            return $membuffer_mb;
        } else if ($args == 'gb') {
            $membuffer_gb = $this->convert($membuffer, 'gb');
            return $membuffer_gb;
        }
    }


    //--------------------------------------------
    //-      Function to get Shmem Mem     -
    //--------------------------------------------
    public function get_shmem_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $shmem = $file_line[20];
        $shmem = filter_var($shmem, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return (int)$shmem;
        } else if ($args == 'mb') {
            $shmem_mb = $this->convert($shmem, 'mb');
            return $shmem_mb;
        } else if ($args == 'gb') {
            $shmem_gb = $this->convert($shmem, 'gb');
            return $shmem_gb;
        }
    }

    //--------------------------------------------
    //-     Function to get SReclaimable Mem     -
    //--------------------------------------------
    public function get_sreclaimable_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $sreclaimable = $file_line[22];
        $sreclaimable = filter_var($sreclaimable, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return (int)$sreclaimable;
        } else if ($args == 'mb') {
            $sreclaimable_mb = $this->convert($sreclaimable, 'mb');
            return $sreclaimable_mb;
        } else if ($args == 'gb') {
            $sreclaimable_gb = $this->convert($sreclaimable, 'gb');
            return $sreclaimable_gb;
        }
    }

    //--------------------------------------------
    //-      Function to get SUnreclaim Mem     -
    //--------------------------------------------
    public function get_sunreclaim_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $sunreclaim = $file_line[23];
        $sunreclaim = filter_var($sunreclaim, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return (int)$sunreclaim;
        } else if ($args == 'mb') {
            $sunreclaim_mb = $this->convert($sunreclaim, 'mb');
            return $sunreclaim_mb;
        } else if ($args == 'gb') {
            $sunreclaim_gb = $this->convert($sunreclaim, 'gb');
            return $sunreclaim_gb;
        }
    }

    //--------------------------------------------
    //-         Function to get Free Mem         -
    //--------------------------------------------
    // From the meminfo file
    public function get_free_mem($args)
    {

        $file = file('/proc/meminfo');
        $file_line = array();

        $file_line = $file;

        $memfree = $file_line[1];
        $memfree = filter_var($memfree, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

        if ($args == 'kb') {
            return  (int)$memfree;
        } else if ($args == 'mb') {
            $memfree_mb = $this->convert($memfree, 'mb');
            return $memfree_mb;
        } else if ($args == 'gb') {
            $memfree_gb = $this->convert($memfree, 'gb');
            return $memfree_gb;
        }
    }


    //--------------------------------------------
    //-         Function to get Used Mem         -
    //--------------------------------------------
    // Formular = MemTotal - MemFree - Buffers - Cached - SReclaimable - Shmem
    public function get_used_mem($args)
    {

        $totalmem = $this->get_total_mem('kb');
        $freemem = $this->get_free_mem('kb');
        $buffers = $this->get_buffer_mem('kb');
        $cachedmem = $this->get_cached_mem('kb');
        $sreclaimable = $this->get_sreclaimable_mem('kb');
        $shmem = $this->get_shmem_mem('kb');

        $usedmem = $totalmem - $freemem - $buffers - $cachedmem - $sreclaimable + $shmem;

        if ($args == 'kb') {
            return (int)$usedmem;
        } else if ($args == 'mb') {
            $usedmem_mb = $this->convert($usedmem, 'mb');
            return $usedmem_mb;
        } else if ($args == 'gb') {
            $usedmem_gb = $this->convert($usedmem, 'gb');
            return $usedmem_gb;
        }
    }


    //--------------------------------------------
    //-      Function to get real Free Mem       -
    //--------------------------------------------
    public function get_realfree_mem($args)
    {

        $totalmem = $this->get_total_mem('kb');
        $usedmem = $this->get_used_mem('kb');

        $realfreemem = $totalmem - $usedmem;

        if ($args == 'kb') {
            return (int)$realfreemem;
        } else if ($args == 'mb') {
            $realfreemem_mb = $this->convert($realfreemem, 'mb');
            return $realfreemem_mb;
        } else if ($args == 'gb') {
            $realfreemem_gb = $this->convert($realfreemem, 'gb');
            return $realfreemem_gb;
        }
    }

    //-------------------------------------------
    //-        Function Used Ram Space (%)      -
    //-------------------------------------------
    public function get_used_mem2()
    {

        $getused = $this->get_used_mem('kb') / $this->get_total_mem('kb');
        $sum = $getused * 100;
        $sum2 = $this->round_up($sum, 2);

        return $sum2;
    }


    //-------------------------------------------
    //-      Function for CPU information       -
    //-------------------------------------------
    //Function to get different data about cpu
    public function get_cpuinfo($arg)
    {

        //'model' This gives you the model of the CPU
        if ($arg == 'model') {
            $file = file('/proc/cpuinfo');
            $cpu_model_line = $file[4];
            $cpumodel = strtr($cpu_model_line, array('model name	: ' => ''));

            return $cpumodel;
        }

        //'cores' This gives you the amount of cores on the cpu
        else if ($arg == 'cores') {
            $file = file('/proc/cpuinfo');
            $cpu_cores_line = $file[12];
            $cpucores = strtr($cpu_cores_line, array('cpu cores	: ' => ''));

            return (int)$cpucores;
        }

        //'speed' This gives you the clock speed of the cpu
        else if ($arg == 'speed') {
            $file = file('/proc/cpuinfo');
            $cpu_speed_line = $file[7];
            $cpuspeed = strtr($cpu_speed_line, array('cpu MHz		: ' => ''));
            $cpuspeed_rounded = $this->round_up($cpuspeed, 2);

            return $cpuspeed_rounded;
        }

        //'cache' This gives you amount of cache the cpu has
        else if ($arg == 'cache') {
            $file = file('/proc/cpuinfo');
            $cpu_cache_line = $file[8];
            $cpucache = strtr($cpu_cache_line, array('cache size	: ' => ''));

            return $cpucache;
        }
    }

    //-------------------------------------------
    //-    Function for CPU Being Used As %     -
    //-------------------------------------------
    public function get_cpu_load()
    {

        $load = sys_getloadavg();
        return $load[0];
    }

    //-------------------------------------------
    //-        Function Total Disk Space        -
    //-------------------------------------------
    public function get_disk_total($arg)
    {

        $kb = disk_total_space("/");
        $mb = $this->convert($kb, 'mb');
        $gb = $this->convert($mb, 'gb');

        if ($arg == 'kb') {
            return (int)$kb;
        } else if ($arg == 'mb') {
            return $mb;
        } else if ($arg == 'gb') {
            return $gb;
        }
    }


    //-------------------------------------------
    //-        Function Disk Free Space        -
    //-------------------------------------------
    public function get_disk_free($arg)
    {

        $kb = disk_free_space("/");
        $mb = $this->convert($kb, 'mb');
        $gb = $this->convert($mb, 'gb');

        if ($arg == 'kb') {
            return (int)$kb;
        } else if ($arg == 'mb') {
            return $mb;
        } else if ($arg == 'gb') {
            return $gb;
        }
    }


    //-------------------------------------------
    //-         Function Used Disk Space        -
    //-------------------------------------------
    public function get_disk_used($arg)
    {

        $total = $this->get_disk_total('kb');
        $free = $this->get_disk_free('kb');

        $kb = $total - $free;
        $mb = $this->convert($kb, 'mb');
        $gb = $this->convert($mb, 'gb');

        if ($arg == 'kb') {
            return (int)$kb;
        } else if ($arg == 'mb') {
            return $mb;
        } else if ($arg == 'gb') {
            return $gb;
        }
    }


    //-------------------------------------------
    //-       Function Used Disk Space (%)      -
    //-------------------------------------------
    public function get_disk_used2()
    {

        $getused = $this->get_disk_used('kb') / $this->get_disk_total('kb');
        $sum = $getused * 100;
        $sum2 = $this->round_up($sum, 2);

        return (int)$sum2;
    }


    //-------------------------------------------
    //-        Function for Rounding up         -
    //-------------------------------------------
    //Function to round numbers up
    public function round_up($value, $precision)
    {
        $pow = pow(10, $precision);
        return (ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value))) / $pow;
    }

    //-------------------------------------------
    //-        Function for Converting          -
    //-------------------------------------------
    //Function to convert to mb, gb
    public function convert($input, $conversion)
    {

        if ($conversion == 'mb') {
            $converted = $input / 1024;
            return $this->round_up($converted, 2);
        } else if ($conversion == 'gb') {
            $converted = $input / 1024 / 1024;
            return $this->round_up($converted, 2);
        }
    }

    //-------------------------------------------
    //-  Function putting all stuff into array  -
    //-------------------------------------------
    public function get()
    {

        //mem array
        $mem = array(
            'totalkb' => $this->get_total_mem('kb'),
            'totalmb' => $this->get_total_mem('mb'),
            'totalgb' => $this->get_total_mem('gb'),

            'availablekb' =>  $this->get_available_mem('kb'),
            'availablemb' =>  $this->get_available_mem('mb'),
            'availablegb' =>  $this->get_available_mem('gb'),

            'cachedkb' => $this->get_cached_mem('kb'),
            'cachedmb' => $this->get_cached_mem('mb'),
            'cachedgb' => $this->get_cached_mem('gb'),

            'swapkb' => $this->get_swap_mem('kb'),
            'swapmb' => $this->get_swap_mem('mb'),
            'swapgb' => $this->get_swap_mem('gb'),

            'bufferkb' => $this->get_buffer_mem('kb'),
            'buffermb' => $this->get_buffer_mem('mb'),
            'buffergb' => $this->get_buffer_mem('gb'),

            'shmemkb' => $this->get_shmem_mem('kb'),
            'shmemmb' => $this->get_shmem_mem('mb'),
            'shmemgb' => $this->get_shmem_mem('gb'),

            'sreclaimablekb' => $this->get_sreclaimable_mem('kb'),
            'sreclaimablemb' => $this->get_sreclaimable_mem('mb'),
            'sreclaimablegb' => $this->get_sreclaimable_mem('gb'),

            'sunreclaimkb' => $this->get_sunreclaim_mem('kb'),
            'sunreclaimmb' => $this->get_sunreclaim_mem('mb'),
            'sunreclaimgb' => $this->get_sunreclaim_mem('gb'),

            'freekb' => $this->get_free_mem('kb'),
            'freemb' => $this->get_free_mem('mb'),
            'freegb' => $this->get_free_mem('gb'),

            'realfreekb' => $this->get_realfree_mem('kb'),
            'realfreemb' => $this->get_realfree_mem('mb'),
            'realfreegb' => $this->get_realfree_mem('gb'),

            'usedkb' => $this->get_used_mem('kb'),
            'usedmb' => $this->get_used_mem('mb'),
            'usedgb' => $this->get_used_mem('gb'),

            'percent' => $this->get_used_mem2()

        );

        //disk array
        $disk = array(
            'totalkb' => $this->get_disk_total('kb'),
            'totalmb' => $this->get_disk_total('mb'),
            'totalgb' => $this->get_disk_total('gb'),

            'freekb' => $this->get_disk_free('kb'),
            'freemb' => $this->get_disk_free('mb'),
            'freegb' => $this->get_disk_free('gb'),

            'usedkb' => $this->get_disk_used('kb'),
            'usedmb' => $this->get_disk_used('mb'),
            'usedgb' => $this->get_disk_used('gb'),

            'percent' => $this->get_disk_used2()

        );

        //cpu array
        $cpu = array(
            'model' =>  $this->get_cpuinfo('model'),
            'cores' => $this->get_cpuinfo('cores'),
            'clock' => $this->get_cpuinfo('speed'),
            'cache' => $this->get_cpuinfo('cache'),
            'load' => $this->get_cpu_load()
        );

        //uptime array
        $uptime = array(
            'days' => $this->get_uptime('days'),
            'hours' => $this->get_uptime('hours'),
            'mins' => $this->get_uptime('mins'),
            'secs' => $this->get_uptime('secs')
        );

        //ip array
        $ip = array(
            'ip' => $this->get_ip()
        );

        $array = array(
            'mem' => $mem,
            'disk' => $disk,
            'cpu' => $cpu,
            'uptime' => $uptime,
            'ip' => $ip,
        );

        return $array;
    }
}


$server = new ServerInfo();
print_r($server->get());