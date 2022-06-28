<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
declare(strict_types=1);

namespace Tall\Report\Writer\ODS\Manager;

use Tall\Report\Writer\Common\Entity\Sheet;
use Tall\Report\Writer\Common\Entity\Workbook;
use Tall\Report\Writer\Common\Manager\AbstractWorkbookManager;
use Tall\Report\Writer\Common\Manager\Style\StyleMerger;
use Tall\Report\Writer\ODS\Helper\FileSystemHelper;
use Tall\Report\Writer\ODS\Manager\Style\StyleManager;
use Tall\Report\Writer\ODS\Options;

/**
 * @internal
 *
 * @property WorksheetManager $worksheetManager
 * @property FileSystemHelper $fileSystemHelper
 * @property StyleManager     $styleManager
 */
final class WorkbookManager extends AbstractWorkbookManager
{
    /**
     * Maximum number of rows a ODS sheet can contain.
     *
     * @see https://ask.libreoffice.org/en/question/8631/upper-limit-to-number-of-rows-in-calc/
     */
    private static int $maxRowsPerWorksheet = 1048576;

    public function __construct(
        Workbook $workbook,
        Options $options,
        WorksheetManager $worksheetManager,
        StyleManager $styleManager,
        StyleMerger $styleMerger,
        FileSystemHelper $fileSystemHelper
    ) {
        parent::__construct(
            $workbook,
            $options,
            $worksheetManager,
            $styleManager,
            $styleMerger,
            $fileSystemHelper
        );
    }

    /**
     * @return int Maximum number of rows/columns a sheet can contain
     */
    protected function getMaxRowsPerWorksheet(): int
    {
        return self::$maxRowsPerWorksheet;
    }

    /**
     * Writes all the necessary files to disk and zip them together to create the final file.
     *
     * @param resource $finalFilePointer Pointer to the spreadsheet that will be created
     */
    protected function writeAllFilesToDiskAndZipThem($finalFilePointer): void
    {
        $worksheets = $this->getWorksheets();
        $numWorksheets = \count($worksheets);

        $this->fileSystemHelper
            ->createContentFile($this->worksheetManager, $this->styleManager, $worksheets)
            ->deleteWorksheetTempFolder()
            ->createStylesFile($this->styleManager, $numWorksheets)
            ->zipRootFolderAndCopyToStream($finalFilePointer)
        ;
    }
}
