import path from 'path'
import fs from 'fs'
import { glob } from 'glob'
import { src, dest, watch, series } from 'gulp'
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'
import terser from 'gulp-terser'
import sharp from 'sharp'

const sass = gulpSass(dartSass)

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js'
}

export function css( done ) {
    src(paths.scss, {sourcemaps: true})
        .pipe( sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError) )
        .pipe( dest('./public/build/css', {sourcemaps: '.'}) );
    done()
}

export function js( done ) {
    src(paths.js)
      .pipe(terser())
      .pipe(dest('./public/build/js'))
    done()
}

export async function imagenes(done) {
    const srcDir = './src/img';
    const buildDir = './public/build/img';
    const images =  await glob('./src/img/**/*')

    images.forEach(file => {
        const relativePath = path.relative(srcDir, path.dirname(file));
        const outputSubDir = path.join(buildDir, relativePath);
        procesarImagenes(file, outputSubDir);
    });
    done();
}

function procesarImagenes(file, outputSubDir) {
    if (!fs.existsSync(outputSubDir)) {
        fs.mkdirSync(outputSubDir, { recursive: true })
    }
    const baseName = path.basename(file, path.extname(file))
    const extName = path.extname(file)

    if (extName.toLowerCase() === '.svg') {
        // Si es un archivo SVG, simplemente cópialo
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
        fs.copyFileSync(file, outputFile);
    } else {
        // Para otros formatos de imagen, procesa con sharp
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
        const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`);
        const outputFileAvif = path.join(outputSubDir, `${baseName}.avif`);
        const options = { quality: 80 };

        sharp(file).toFormat('jpeg').jpeg(options).toFile(outputFile);
        sharp(file).toFormat('webp').webp(options).toFile(outputFileWebp);
        sharp(file).toFormat('avif').avif(options).toFile(outputFileAvif);
    }
}


export function dev() {
    watch( paths.scss, css );
    watch( paths.js, js );
    watch('src/img/**/*.{png,jpg}', imagenes)
}

export default series( js, css, imagenes, dev )