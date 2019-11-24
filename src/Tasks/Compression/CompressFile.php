<?php namespace BackupManager\Tasks\Compression;

use BackupManager\ShellProcessing\ShellProcessFailed;
use BackupManager\Tasks\Task;
use BackupManager\Compressors\Compressor;
use BackupManager\ShellProcessing\ShellProcessor;

/**
 * Class CompressFile
 * @package BackupManager\Tasks\Compression
 */
class CompressFile implements Task
{
    /** @var string */
    private $sourcePath;
    /** @var ShellProcessor */
    private $shellProcessor;
    /** @var Compressor */
    private $compressor;

    /**
     * @param Compressor $compressor
     * @param $sourcePath
     * @param ShellProcessor $shellProcessor
     */
    public function __construct(Compressor $compressor, $sourcePath, ShellProcessor $shellProcessor)
    {
        $this->compressor = $compressor;
        $this->sourcePath = $sourcePath;
        $this->shellProcessor = $shellProcessor;
    }

    /**
     * @throws ShellProcessFailed
     */
    public function execute()
    {
        return $this->shellProcessor->process(
            $this->compressor->getCompressCommandLine($this->sourcePath)
        );
    }
}
