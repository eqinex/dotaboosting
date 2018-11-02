<?php

namespace App\Controller;

use App\Entity\User;
use App\Traits\RepositoryAwareTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    use RepositoryAwareTrait;

    /**
     * @Route("/profile", name="profile")
     */
    public function detailsAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($request->getMethod() == "POST") {
            $profile = $request->get('profile');
            $userImage = $request->files->get('user_image');

            if (!empty($profile['firstName'])) {
                $user->setFirstName($profile['firstName']);
            }

            if (!empty($profile['lastName'])) {
                $user->setLastName($profile['lastName']);
            }

            if ($userImage instanceof UploadedFile) {
                $imageUrl = $this->moveFile($userImage, md5(time() . $user->getUsername()));

                $user->setImageUrl($imageUrl);
            }

            $this->getEm()->persist($user);
            $this->getEm()->flush();
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @param UploadedFile $file
     * @param $filename
     * @return string
     * @throws \Exception
     */
    protected function moveFile(UploadedFile $file, $filename)
    {
        // Generate a unique name for the file before saving it
        $fileName = $filename .'.'.$file->guessExtension();

        if ($file->getSize() > 10000000) {
            throw new \Exception("Максимальный размер файла {$filename} 10MB");
        }

        // Move the file to the directory where brochures are stored
        $file->move(
            $this->getParameter('kernel.project_dir') . '/public/user_images',
            $fileName
        );

        $fileUrl = $this->getParameter('kernel.project_dir') . '/public/user_images/' . $fileName;

        $thumb = new \Imagick($fileUrl);
        $thumb->resizeImage(400, 300, \Imagick::FILTER_LANCZOS, 1, 0);
        $thumb->writeImage($fileUrl);

        return '/public/user_images/' . $fileName;
    }
}