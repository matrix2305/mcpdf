# PHP wrapper for MCPDF

This package uses Java package created by m-click (m-click/mcpdf).

### Mcpdf

Mcpdf is an alternative to PDFtk with fixed unicode issues, so you can write Łódź into your forms.

It implements a small subset of PDFtk for which it implements compatible command line interface, so it can be used as a drop-in replacement for this subset of commands.

Internally it uses the iText PDF library.

### Getting Started

Make sure you have installed a Java Runtime Environment such as OpenJDK.

### Xfdf

This package has XfdfDocument class for generating Xfdf document.

#### Example of filling PDF fields:

```
    use matrix2305\Pdf\MCPDF;

    require 'vendor/autoload.php';
    
    $mcpdf = new MCPDF();
    
    $xfdf = new \matrix2305\Xfdf\XfdfDocument();
    $xfdf->addField('date', '23.05.1998');
    $xfdfPath = __DIR__.'/test.xfdf';
    $xfdf->save($xfdfPath);
    
    $mcpdf->setDataXfdfPath($xfdfPath);
    $mcpdf->setFlatten(true);
    $mcpdf->setFromPDFFilePath(__DIR__.'/test.pdf');
    $mcpdf->saveAs(__DIR__.'/output.pdf');
```

#### Example of set background PDF:

```
    use matrix2305\Pdf\MCPDF;

    require 'vendor/autoload.php';
    
    $mcpdf = new MCPDF();
    $mcpdf->setBackgroundPdfPath($backgroundPdfFilePath);
    $mcpdf->setFromPDFFilePath(__DIR__.'/test.pdf');
    $mcpdf->saveAs(__DIR__.'/fsafs.pdf');
```

#### Set Java path manually
```
    use matrix2305\Pdf\MCPDF;

    require 'vendor/autoload.php';
    
    $mcpdf = new MCPDF();
    $mcpdf->setJavaPath($pathToJava);
```
