<?php namespace ExtendedSlim\Factories;

use Exception;
use ExtendedSlim\Exceptions\TranslationException;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\Loader\PoFileLoader;
use Symfony\Component\Translation\Translator;

class TranslatorFactory
{
    /**
     * @param string $translationResourcePath
     *
     * @return Translator
     * @throws Exception
     */
    public function create(string $translationResourcePath): Translator
    {
        $fileFormat = env('TRANSLATION_FORMAT');
        $languages  = explode(',', env('TRANSLATION_LANGUAGES'));

        $translator = new Translator(env('TRANSLATION_DEFAULT_LANGUAGE'));
        $translator->addLoader($fileFormat, $this->getLoader($fileFormat));
        foreach ($languages as $language)
        {
            $translator->addResource($fileFormat, $translationResourcePath . $language . '.' . $fileFormat, $language);
        }

        return $translator;
    }

    /**
     * @param string $translationFileFormat
     *
     * @return LoaderInterface
     *
     * @throws TranslationException
     */
    private function getLoader(string $translationFileFormat): LoaderInterface
    {
        if ($translationFileFormat === 'po')
        {
            return new PoFileLoader();
        }
        throw new TranslationException(sprintf('Missing translation loader: %s', $translationFileFormat));
    }
}
