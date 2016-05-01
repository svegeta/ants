<!-- File: /app/View/Posts/index.ctp -->

<h1>Downloads</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>Beschreibung</th>
        <th>Datum</th>
        <th>Download</th>
    </tr>

    <?php foreach ($downloads as $download): ?>
    <tr>
        <td><?php echo $download['Download']['id']; ?></td>
        <td><?php echo $this->Html->image('downloads/'.$download['Download']['image_file']); ?></td>
        <td><?php echo $download['Download']['title']; ?></td>
        <td><?php echo $download['Download']['description']; ?></td>
        <td>
            <?php echo $this->Time->format($download['Download']['date'],'%d.%m.%Y'); ?>
        </td>
        <td><?php echo $this->Html->link(">>>".$download['Download']['download_file']."<<<", array('controller' => 'downloads', 'action' => 'download', $download['Download']['id'])); ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($download); ?>
</table>