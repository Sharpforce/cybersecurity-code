const express = require('express');
const multer = require('multer');
const path = require('path');

const app = express();
const port = 3000;

app.use('/js', express.static(path.join(__dirname, 'js')));
app.use('/styles', express.static(path.join(__dirname, 'styles')));

const { v4: uuidv4 } = require('uuid');
const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './uploads/');
    },
    filename: function (req, file, cb) {
        const extension = file.originalname.split('.').pop();
        const randomFilename = uuidv4() + '.' + extension;
        cb(null, randomFilename);
    }
});

const fileFilter = function (req, file, cb) {
    const extension = file.originalname.split('.').pop();

    if ((extension === 'html' || extension === 'svg' || extension === 'xhtml')  && (file.mimetype === 'text/html' || file.mimetype === 'image/svg+xml' || file.mimetype === 'application/xhtml+xml')) {
        cb(null, true);
    }  else {
        cb(null, false);
    }
};

const upload = multer({ storage: storage, fileFilter: fileFilter, limits:{ fileSize: 1024 * 1024 } });

app.use('/uploads', (req, res, next) => {
    res.setHeader(
        'Content-Security-Policy', 
        "default-src 'self'; script-src 'none'; style-src 'none'; font-src 'none'; img-src 'none'; frame-src 'none'; object-src 'none'"
    );
    next();
});

app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

app.post('/upload', upload.single('file'), (req, res) => {
    const file = req.file;

    if (!file) {
        return res.status(400).send('Seuls les fichiers HTML, SVG et XHTML sont autorisés');
    }
    
    const fileUrl = `${req.protocol}://${req.get('host')}/uploads/${file.filename}`;
    res.send(`Le fichier a été téléchargé avec succès. Voici le lien pour y accéder : <a href="${fileUrl}">${fileUrl}</a><br><a href="${req.protocol}://${req.get('host')}">Retour</a>`);
});

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, './index.html'));
});

app.listen(port, () => {
    console.log(`Le serveur écoute sur le port ${port}`);
});