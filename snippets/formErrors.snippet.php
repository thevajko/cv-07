/**
 * Validates the post form.
 *
 * @param Request $request
 * @return string[] List of error messages, empty if the form is valid.
 */
private function formErrors(Request $request): array
{
    $errors = [];
    if ($request->file('picture')->getName() == "") {
        $errors[] = "Pole Súbor obrázka musí byť vyplnené!";
    }
    if ($request->value('text') == "") {
        $errors[] = "Pole Text príspevku musí byť vyplnené!";
    }
    if ($request->file('picture')->getName() != "" &&
        !in_array($request->file('picture')->getType(), ['image/jpeg', 'image/png'])) {
        $errors[] = "Obrázok musí byť typu JPG alebo PNG!";
    }
    if ($request->value('text') != "" && strlen($request->value('text')) < 5) {
        $errors[] = "Počet znakov v text príspevku musí byť viac ako 5!";
    }
    return $errors;
}