<?php
// 代码生成时间: 2025-09-24 01:14:37
use Cake\Http\Exception\NotFoundException;
use Cake\Controller\Controller;

class ThemeSwitcherController extends Controller
{
    /**
     * Switches the theme for the current session.
     *
     * @param string $theme The name of the theme to switch to.
     * @return void
     * @throws NotFoundException If the theme does not exist.
     */
    public function switchTheme($theme)
    {
        // Check if the theme exists in the list of available themes.
        $availableThemes = ['light', 'dark', 'colorful'];
        if (!in_array($theme, $availableThemes)) {
            // Throw a NotFoundException if the theme is not available.
            throw new NotFoundException("Theme '{$theme}' not found.");
        }

        // Set the theme in the session.
        $this->request->getSession()->write('theme', $theme);

        // Redirect back to the previous page or a default page.
        $this->redirect($this->referer());
    }
}
