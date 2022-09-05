<?php
declare(strict_types=1);
namespace matrix2305\Pdf;

use Exception;
use Symfony\Component\Process\Process;

class MCPDF
{
    private string $java = 'java';
    private string $dataXfdfPath = '';
    private string $fromPDFFilePath = '';
    private string $backgroundPdfPath = '';
    private bool $flatten = false;

    /**
     * @param string $java
     * @return $this
     */
    public function setJavaPath(string $java) : self
    {
        $this->java = $java;
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setDataXfdfPath(string $path) : self
    {
        $this->dataXfdfPath = $path;
        return $this;
    }

    /**
     * @param string $backgroundPdfPath
     * @return MCPDF
     */
    public function setBackgroundPdfPath(string $backgroundPdfPath): self
    {
        $this->backgroundPdfPath = $backgroundPdfPath;
        return $this;
    }

    /**
     * @param bool $flatten
     */
    public function setFlatten(bool $flatten): void
    {
        $this->flatten = $flatten;
    }

    /**
     * @param string $fromPDFFilePath
     */
    public function setFromPDFFilePath(string $fromPDFFilePath): void
    {
        $this->fromPDFFilePath = $fromPDFFilePath;
    }

    /**
     * @throws Exception
     */
    public function saveAs(string $path) : void
    {
        $mcpdfPath = __DIR__ . '/../mcpdf.jar';
        $command = "$this->java -jar $mcpdfPath";

        if (!$this->fromPDFFilePath) {
            throw new Exception('From PDF file path must have value.');
        }

        $command .= " $this->fromPDFFilePath fill_form";

        if ($this->backgroundPdfPath) {
            $command .= " background $this->backgroundPdfPath output - > $path";
            $this->executeCommand($command);
            return;
        }

        if (!$this->dataXfdfPath) {
            throw new Exception('Data XFDF path must have value.');
        }

        $command .= " - output";

        if ($this->flatten) {
            $command .= ' - flatten';
        }

        $command .= " < $this->dataXfdfPath > $path";

        $this->executeCommand($command);
    }

    /**
     * @param string $command
     * @return void
     */
    private function executeCommand(string $command) : void
    {
        $process = Process::fromShellCommandline($command);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new MCPDFException($process);
        }
    }
}
