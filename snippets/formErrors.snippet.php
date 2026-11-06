/**
 * Validates the post form.
 *
 * @param Request $request
 * @param bool $isNew True for a new post, the picture is required only for a new post.
 * @return string[] List of error messages, empty if the form is valid.
 */
private function formErrors(Request $request, bool $isNew): array
{
    $errors = [];
    $picture = $request->file('picture');
    if ($picture == null || $picture->getName() == "") {
        if ($isNew) {
            $errors[] = "Pole Súbor obrázka musí byť vyplnené!";
        }
    } elseif ($picture->getError() == UPLOAD_ERR_INI_SIZE) {
        $errors[] = "Obrázok je príliš veľký, maximálna veľkosť je " . ini_get('upload_max_filesize') . "B!";
    } elseif (!$picture->isOk()) {
        $errors[] = "Obrázok sa nepodarilo nahrať!";
    } elseif (!in_array($picture->getType(), ['image/jpeg', 'image/png'])) {
        $errors[] = "Obrázok musí byť typu JPG alebo PNG!";
    }
    if ($request->value('text') == "") {
        $errors[] = "Pole Text príspevku musí byť vyplnené!";
    }
    if ($request->value('text') != "" && mb_strlen($request->value('text')) < 5) {
        $errors[] = "Text príspevku musí mať aspoň 5 znakov!";
    }
    return $errors;
}