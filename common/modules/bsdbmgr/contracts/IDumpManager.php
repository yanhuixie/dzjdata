<?php

namespace common\modules\bsdbmgr\contracts;

/**
 * Interface IDumpManager.
 *
 * @package common\modules\bsdbmgr\contracts
 */
interface IDumpManager
{
    /**
     * @param $basePath
     * @param array $dbInfo
     * @param array $dumpOptions
     * @return string
     */
    public function makePath($basePath, array $dbInfo, array $dumpOptions);

    /**
     * @param $path
     * @param array $dbInfo
     * @param array $dumpOptions
     * @return string
     */
    public function makeDumpCommand($path, array $dbInfo, array $dumpOptions);

    /**
     * @param $path
     * @param array $dbInfo
     * @param array $restoreOptions
     * @return string
     */
    public function makeRestoreCommand($path, array $dbInfo, array $restoreOptions);
}
